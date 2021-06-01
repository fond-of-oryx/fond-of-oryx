# Payment QR-Code Generator

[![license](https://img.shields.io/github/license/fond-of-oryx/qr-code-generator.svg)](https://packagist.org/packages/fond-of-oryx/qr-code-generator)

## Description
Wrapper package for "endroid/qr-code". Provides service in spryker for easy generating QR-Codes.

## Installation

```
composer require fond-of-oryx/qr-code-generator
```

## Usage

Grab the service and use createQrCode(QrCodeGeneratorRequestTransfer $qrCodeGeneratorRequestTransfer) to generate a QR Code

## Configuration

| Const                          | Default         | Note                                       |
|:-------------------------------|:----------------|:-------------------------------------------|
| QR_CODE_FORMAT                 | png             | format (png, svg, binary, eps, pdf, debug) |
| QR_CODE_ENCODING               | UTF-8           | encoding                                   |
| QR_CODE_ERROR_CORRECTION_LEVEL | 1               | low 0, medium 1, high 2, quartile 3        |
| QR_CODE_SIZE                   | 250             | size in pixel                              |
| QR_CODE_MARGIN                 | 5               | space from border                          |
| QR_CODE_FOREGROUND_COLOR       | [0, 0, 0]       | [red, green, blue] black                   |
| QR_CODE_ROUNDED_BLOCK_SIZE_MODE| 1               | none 0, margin 1, enlarge 2, shrink 3      |
| QR_CODE_BACKGROUND_COLOR       | [255, 255, 255] | [red, green, blue] white                   |
