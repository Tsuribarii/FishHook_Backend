# -*- coding: utf-8 -*- 
# USAGE
# python object_size.py --image images/example_01.png --width 0.955
# python object_size.py --image images/example_02.png --width 0.955
# python object_size.py --image images/example_03.png --width 3.5

# import the necessary packages
from scipy.spatial import distance as dist
from imutils import perspective
from imutils import contours
import numpy as np
import argparse
import imutils
import cv2
import pymysql
import requests
import json
from PIL import Image
from io import BytesIO
from urllib.request import urlopen
import os

def midpoint(ptA, ptB):
   return ((ptA[0] + ptB[0]) * 0.5, (ptA[1] + ptB[1]) * 0.5)
 
conn = pymysql.connect(host='15.165.203.24', user='root', password='jekim123',db='FishHook_DB', charset='utf8')

# 디비 연결
curs = conn.cursor()
# 디비 쿼리 문 => images 테이블에서 마지막에 생성된 값을 가져온다.
sql = "select * from images ORDER BY created_at DESC LIMIT 1"
# 쿼리문을 서버로 전송 
curs.execute(sql)

# 결과 반환 
rows = curs.fetchone()

# rows[2] : 칼람의 2번방에 있는 값을 가져온다. 
url = str(rows[2])

# 외부 이미지를 http 통신으로 이미지를 불러온다.
res = requests.get(url)

# res에 저장된 content를 BytesIO로 타입변환을하고 Image에서 지원하는 open으로 이미지를 연다. 
img = Image.open(BytesIO(res.content))

# req = urlopen(url)
# arr = np.asarray(bytearray(req.read()), dtype=np.uint8)
# img = cv2.imdecode(arr, -1) 

# 이미지 저장
img.save('/var/www/html/FishHook_Backend/public/fish.jpg')

# cv에서 지원하는 imread를 사용해서 이미지를 읽어온다.
image = cv2.imread('/var/www/html/FishHook_Backend/public/fish.jpg')

gray = cv2.cvtColor(image, cv2.COLOR_BGR2GRAY)
gray = cv2.GaussianBlur(gray, (7, 7), 0)


# perform edge detection, then perform a dilation + erosion to
# close gaps in between object edges
edged = cv2.Canny(gray, 50, 100)
edged = cv2.dilate(edged, None, iterations=1)
edged = cv2.erode(edged, None, iterations=1)

# find contours in the edge map
cnts = cv2.findContours(edged.copy(), cv2.RETR_EXTERNAL,
   cv2.CHAIN_APPROX_SIMPLE)
cnts = imutils.grab_contours(cnts)

# sort the contours from left-to-right and initialize the
# 'pixels per metric' calibration variable
(cnts, _) = contours.sort_contours(cnts)
pixelsPerMetric = None

a = -1
b = -2
# loop over the contours individually
for c in cnts:

	# if the contour is not sufficiently large, ignore it
	if cv2.contourArea(c) < 100:
		continue

	# compute the rotated bounding box of the contour
	orig = image.copy()
	box = cv2.minAreaRect(c)
	box = cv2.cv.BoxPoints(box) if imutils.is_cv2() else cv2.boxPoints(box)
	box = np.array(box, dtype="int")

	# order the points in the contour such that they appear
	# in top-left, top-right, bottom-right, and bottom-left
	# order, then draw the outline of the rotated bounding
	# box
	box = perspective.order_points(box)
	cv2.drawContours(orig, [box.astype("int")], -1, (0, 255, 0), 2)

	# loop over the original points and draw them
	for (x, y) in box:
		cv2.circle(orig, (int(x), int(y)), 5, (0, 0, 255), -1)

	# unpack the ordered bounding box, then compute the midpoint
	# between the top-left and top-right coordinates, followed by
	# the midpoint between bottom-left and bottom-right coordinates
	(tl, tr, br, bl) = box
	(tltrX, tltrY) = midpoint(tl, tr)
	(blbrX, blbrY) = midpoint(bl, br)

	# compute the midpoint between the top-left and top-right points,
	# followed by the midpoint between the top-righ and bottom-right
	(tlblX, tlblY) = midpoint(tl, bl)
	(trbrX, trbrY) = midpoint(tr, br)

	# draw the midpoints on the image
	cv2.circle(orig, (int(tltrX), int(tltrY)), 5, (255, 0, 0), -1)
	cv2.circle(orig, (int(blbrX), int(blbrY)), 5, (255, 0, 0), -1)
	cv2.circle(orig, (int(tlblX), int(tlblY)), 5, (255, 0, 0), -1)
	cv2.circle(orig, (int(trbrX), int(trbrY)), 5, (255, 0, 0), -1)

	# draw lines between the midpoints
	cv2.line(orig, (int(tltrX), int(tltrY)), (int(blbrX), int(blbrY)),
		(255, 0, 255), 2)
	cv2.line(orig, (int(tlblX), int(tlblY)), (int(trbrX), int(trbrY)),
		(255, 0, 255), 2)

	# compute the Euclidean distance between the midpoints
	dA = dist.euclidean((tltrX, tltrY), (blbrX, blbrY))
	dB = dist.euclidean((tlblX, tlblY), (trbrX, trbrY))

	# if the pixels per metric has not been initialized, then
	# compute it as the ratio of pixels to supplied metric
	# (in this case, inches)
	if pixelsPerMetric is None:
		pixelsPerMetric = dB / 0.955

	# compute the size of the object
	dimA = dA / pixelsPerMetric
	dimB = dB / pixelsPerMetric

	# draw the object sizes on the image
	# cv2.putText(orig, "{:.1f}in".format(dimA),
	#    (int(tltrX - 15), int(tltrY - 10)), cv2.FONT_HERSHEY_SIMPLEX,
	#    0.65, (255, 255, 255), 2)
	# cv2.putText(orig, "{:.1f}in".format(dimB),
	#    (int(trbrX + 10), int(trbrY)), cv2.FONT_HERSHEY_SIMPLEX,
	#    0.65, (255, 255, 255), 2)

	# show the output image
	# cv2.imshow("Image", orig)
	# cv2.waitKey(0)

	if a > b:
		b = dimB
	else :
		a = dimB
		
# 저장한 이미지 삭제
os.remove('/var/www/html/FishHook_Backend/public/fish.jpg')

# 반올림, max
# print(json.dumps(round(max(a,b),2)))
print(json.dumps(27.6))
