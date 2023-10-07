
export NAMESPACE   	= b2b.docker.lamoda.ru/hackaton

export VERSION 		?= $(if $(filter TRUE,$(CI)),$(shell git describe --tags 2> /dev/null || git rev-parse --short HEAD),latest)


## Build all containers
build:
	docker build \
    		-t $(NAMESPACE)/php:$(VERSION) \
		  	-f ./docker/Dockerfile-php \
    		.
	docker build \
			-t $(NAMESPACE)/nginx:$(VERSION) \
			-f ./docker/Dockerfile-nginx \
			.

push:
	docker push $(NAMESPACE)/php:$(VERSION)
	docker push $(NAMESPACE)/nginx:$(VERSION)
