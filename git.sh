#!/bin/bash

git pull origin master
git add --all
if [ -z "$1" ]; then
	git commit -m "git script-> repo updated"
else
	git commit -m "$1"
fi
git push origin master
