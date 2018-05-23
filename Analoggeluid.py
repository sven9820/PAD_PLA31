import spidev
import time
from time import sleep
import os
import csv
import datetime
import http
import urllib.request

reportTime = (time.strftime("%Y-%d-%m %H:%M:%S"))
array = []

#open SPI bus
spi = spidev.SpiDev()
spi.open(0,0)

#sensor channels
geluidHigh = 0

#declare variables
totaal = 0
average = totaal/60
key = 'BRL3MVTNLH6N5AH6' #API key voor Thingspeak

def getReading(channel):
    # first pull raw data from chip
    rawData = spi.xfer([1, (8 + channel) << 4, 0])
    # process the raw data into something we understand
    processedData = ((rawData[1]&3) << 8) + rawData[2]
    return processedData

def postReading():
    link = urllib.request.urlopen("https://api.thingspeak.com/update?api_key=BRL3MVTNLH6N5AH6&field1=" + str(average))

while True:
    #dataHigh = getReading(geluidHigh)
    #print(reportTime)

    for x in range(60):
        dataHigh = getReading(geluidHigh)
        totaal + dataHigh
        print(dataHigh)
        print(x)
        sleep(1)

    if x == 59:
        postReading()
        print("printed")
        totaal = 0
