FROM nginx:1.13-alpine

COPY ./config /tmp
RUN mv /tmp/site.conf /etc/nginx/conf.d/default.conf \
 && mv /tmp/entrypoint.sh /root/entrypoint.sh \
 && mv /tmp/ssl-certs /etc/nginx/ \
 && apk add --no-cache tzdata

STOPSIGNAL SIGTERM

ENTRYPOINT ["/bin/sh","/root/entrypoint.sh"]
CMD ["nginx", "-g", "daemon off;"]
