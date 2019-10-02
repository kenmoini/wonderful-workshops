# bastion-container

Simply put, this is a container that has Bash, ZSH, OC, kubectl, OpenSSH Server and a few other handy tools that would be needed when serviced as a Bastion Host for workshops, or anything really.  It's just a jump-container!

A few details...

1) Built on CentOS.  Was going to be Red Hat Universal Base Image but had too many issues with that and Python and other silly things...
2) Exposes SSH on port 2222, this way you can run it on Red Hat OpenShift
3) Batch users are created, prefixed by student-userXX where XX is replaced by 0-100.  Details in the ```user-list.txt``` file, user configuration executed by ```batch-user-config.sh```.
4) Packages installed...
  - wget, curl, unzip, ed
  - nano, vim, git
  - openssh, openssh-server, openssh-server-sysvinit
  - nodejs 10, npm
  - gcc, gcc-c++, gcc-gfortran, gettext, initscripts, libtool, patch, make, ncurses-devel
  - python3-pip, python3, python3-setuptools, python3-devel
  - Powerline Fonts, ZSH, thefuck, Oh-My-ZSH
  - Ansible, OpenShift CLI, & kubectl

## Usage

### Build from Dockerfile

Building this Bastion container is pretty easy, you'll need to grab all the files in this repo though.

```
# git clone https://github.com/kenmoini/wonderful-workshops
# cd wonderful-workshops/bastion-container
# docker build - < Dockerfile
```

Then run ```docker run -p 2222:2222``` and the image checksom of whatever was built.  In doing so, you'll launch a container with an OpenSSH Server running on it in the background.  Use ```ssh -p 2222 student-user0@localhost``` to connect to the container.

### Run from Docker Hub

Just want to use a pre-built and public container image?  Sure, no problem...

```
# docker run -p 2222:2222 kenmoini/wonderful-workshops-bastion:latest
```

Use ```ssh -p 2222 student-user0@localhost``` to connect to the container.

### Deploy to OpenShift

One of those fancy fucks with an OCP cluster?  Dope - use the template in this repository to quickly deploy this same cluster.

```
# oc create -f https://raw.githubusercontent.com/kenmoini/wonderful-workshops/master/bastion-container/openshift-template.yml
# oc new-app ww-bastion
```

This will create...

- A Deployment Configuration that pulls in the container image from Docker Hub - version can be set with a parameter in the template
- A Service that can be set via parameter
- A Route to expose the Service

#### ***NOTE:*** I would advise securing that Route with whatever means you do.  SSH over an insecure web browser is...dumb.  I can't predict how your cluster terminates SSL though - cert-manager, certmonger, Let's Encrypt, edge load balancer termination, etc.

You can use this container in combination with the Wonderful Workshops' WebSSH2 container to create a web accessible bastion host.