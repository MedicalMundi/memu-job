FROM webdevops/php-dev:7.4-alpine

# Fix Apple Silicon M1 ARM problem
# see https://github.com/webdevops/Dockerfile/issues/395
RUN wget -O "/usr/local/bin/go-replace" "https://github.com/webdevops/goreplace/releases/download/1.1.2/gr-arm64-linux" \
    && chmod +x "/usr/local/bin/go-replace" \
    && "/usr/local/bin/go-replace" --version