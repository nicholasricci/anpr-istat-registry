#!/bin/bash

docker run --rm -i -t -u $(id -u):$(id -g) --name=anpr-istat-registry \
  -v $PWD:/var/www/html \
  anpr-istat-registry bash