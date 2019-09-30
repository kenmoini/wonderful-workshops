FROM node:8.6

WORKDIR /usr/src
COPY app/ /usr/src/
RUN npm install --production
EXPOSE 8888
EXPOSE 8989
CMD npm run start
