#!/bin/bash

for i in {0..100}; do
  cp /tmp/working/zshrc /tmp/working/inprog_zshrc
  sed "s/USER_HERE/student-user${i}/" /tmp/working/inprog_zshrc > /home/student-user${i}/.zshrc
  cp -r /root/.oh-my-zsh/ /home/student-user${i}/
  mkdir -p /home/student-user${i}/.local/share
  cp -r /root/.local/share/fonts/ /home/student-user${i}/.local/share/
  chown -R student-user${i}:student-user${i} /home/student-user${i}
done