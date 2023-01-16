#!/bin/sh

nginx
nginx -s reload

while true; do sleep 1000; done