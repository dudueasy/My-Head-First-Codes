#!/usr/bin/env python
# -*- coding: utf-8 -*-
import getpass
'''exercises'''
#1
count=1
while True:
    print(count)
    count += 1 
    if count == 11:
        break


#2
sum =0
for i in range(1,10):
    sum += i

print(sum)

#3
sum = 0
for i in range(1,101):
    if i%2 == 1:
        sum += i

print(sum)

#4 
sum = 0
for i in range(1,101):
    if i%2 == 0:
        sum += i 
print(sum)

#5
sum = 0
for i in range(1,100):
    if i%2 == 1:
        sum += i
    elif i%2 == 0:
        sum -= i 
print(sum)

