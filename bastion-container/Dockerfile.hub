#FROM registry.access.redhat.com/ubi7/ubi-init:latest
FROM centos:7

USER root

RUN mkdir -p /tmp/working && cd /tmp/working

WORKDIR /tmp/working

COPY bastion-container/user-list.txt /tmp/working/user-list.txt
COPY bastion-container/zshrc /tmp/working/zshrc
COPY bastion-container/batch-user-config.sh /tmp/working/batch-user-config.sh

RUN yum update -y && yum clean all

RUN yum install wget ed curl nano vim gcc gcc-c++ gcc-gfortran gettext initscripts openssh openssh-server openssh-server-sysvinit libtool patch git make ncurses-devel python3-pip python3 python3-setuptools python3-devel unzip ansible zsh rsyslog -y && yum clean all

RUN yum install -y epel-release && yum install nodejs npm -y && yum clean all

# RH UBI doesn't come with ZSH as a yum package...
#RUN wget -O zsh-5.7.1.tar.xz "https://downloads.sourceforge.net/project/zsh/zsh/5.7.1/zsh-5.7.1.tar.xz?r=https%3A%2F%2Fsourceforge.net%2Fprojects%2Fzsh%2Ffiles%2Fzsh%2F5.7.1%2Fzsh-5.7.1.tar.xz%2Fdownload&ts=1569732719" && \
#    tar xf zsh-5.7.1.tar.xz && cd zsh-5.7.1 && \
#    ./configure && make && make install && \

RUN cat "$(which zsh)" >> /etc/shells && \
    git clone https://github.com/powerline/fonts.git --depth=1 && \
    cd fonts && ./install.sh && cd .. && rm -rf fonts/ && \
    pip3 install thefuck && \
    sh -c "$(curl -fsSL https://raw.githubusercontent.com/robbyrussell/oh-my-zsh/master/tools/install.sh)" && \
    wget -O oc.tar.gz "https://github.com/openshift/origin/releases/download/v3.11.0/openshift-origin-client-tools-v3.11.0-0cbc58b-linux-64bit.tar.gz" && \
    tar zxvf oc.tar.gz && cd openshift-origin-client-* && mv kubectl /usr/local/bin && mv oc /usr/local/bin && \
    newusers /tmp/working/user-list.txt && sh /tmp/working/batch-user-config.sh && \
    rm -rf /tmp/working

RUN adduser --system -s /bin/bash -u 1234321 -g 0 ossh && \
    usermod -a -G wheel ossh && \
    mkdir -p /opt/ssh && \
    chmod 640 /etc/passwd /etc/group /etc/shadow && \
    mkdir /.npm && \
    mkdir -p /home/ossh && \
    chown ossh /home/ossh && \
    mkdir -p /var/run/sshd && \
    mkdir -p /var/lock/subsys && \
    touch /var/lock/subsys/sshd /var/log/{messages,secure,spooler,maillog} && \
    chmod 777 /var/log/{messages,secure,spooler,maillog} /var/lock/subsys/sshd /var/run/sshd /home/ossh /etc/ssh /var/run /.npm && \
    chown root:wheel /etc/shadow /etc/passwd /etc/group && \
    chmod -R 777 /var/log /opt && \
    sed 's@session\s*required\s*pam_loginuid.so@session optional pam_loginuid.so@g' -i /etc/pam.d/sshd

COPY bastion-container/sshd_config /etc/ssh/sshd_config
COPY bastion-container/server.js /opt/server.js

EXPOSE 2222
EXPOSE 8989

# FYI sed -i uses a temporary fail which approach fails
CMD echo -e ",s/1234321/`id -u`/g\\012 w" | ed -s /etc/passwd && \
    mkdir -p /home/ossh/.ssh && \
    touch /home/ossh/.ssh/authorized_keys && \
    chmod 700 /home/ossh/.ssh && \
    chmod 600 /home/ossh/.ssh/authorized_keys && \
    ssh-keygen -A && \
    rsyslogd -D && \
    npm install --prefix /opt express && \
    nohup /usr/sbin/sshd -D -e > sshd.log && \
    nohup node /opt/server.js > nodeserver.log &