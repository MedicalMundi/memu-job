.PHONY: build-phpfpm
build-phpfpm:  ## (Local) Docker build php-fpm-7.4 image
	docker build -f docker/php/Dockerfile -t memu/memu-job/local:php-fpm-7.4 .

.PHONY: prod-build-phpfpm
prod-build-phpfpm:  ## (Production) Docker build php-fpm-7.4 image
	docker build -f docker/php/Dockerfile -t memu/memu-job:php-fpm-7.4 .

.PHONY: deploy-phpfpm
deploy-phpfpm:  ## (Production) Deploy php-fpm-7.4 image on dockerhub registry
	docker push memu/memu-job:php-fpm-7.4

.PHONY: prod-tag
prod-tag:  ## (Production) Tag local images with production tag before docker push
	docker tag memu/memu-job/local:php-fpm-7.4 memu/memu-job:php-fpm-7.4

.PHONY: clean-dangling-images
clean-dangling-images: ## Remove all dangling images
	docker rmi -f $(docker images -f "dangling=true" -q)
