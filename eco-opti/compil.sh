#!/bin/bash

cp Headers/*.h .
cp Sources/*.c .
make clean
make
rm *.h
rm *.c
mv *.o Binary