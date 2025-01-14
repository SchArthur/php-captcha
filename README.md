# php-captcha

CAPTCHA generator for PHP

## Table of Contents

- [Description](#description)
- [Installation](#installation)
- [Usage](#usage)
- [Examples](#examples)

## Description

A PHP script designed to generate a simple CAPTCHA to prevent bot spamming on web forms. The script generates and displays an image containing a 4-digit number, rendered in a distorted font that is hard for bots to read. The user must enter the number shown in the image to verify their identity before proceeding with the form submission.

## Installation

### Prerequisites

* A working PHP installation.
* Some "destroy" style fonts (in .ttf format) for generating the CAPTCHA text.

### Steps

1. Add your fonts files in `$_SERVER["DOCUMENT_ROOT"] . "/fonts/captcha/"`.
2. Place the `captcha.php` file in your project directory.

## Usage

### Steps

1. In your form, add an `<img>` tag with the `src` attribute pointing to the path of `captcha.php` to display the CAPTCHA image.
2. Add an input field to allow the user to enter their answer (the CAPTCHA value).
3. In your form processing file, validate the user's input by comparing it with the generated CAPTCHA value to ensure it's correct.
4. Make sure to add a button that would refresh the `<img>` `src`.

### Examples

#### Simple form displaying the generated CAPTCHA

```html
<form method="POST">
    <div>
        <label for="captcha_image">CAPTCHA Image</label>
        <img src="/captcha.php" alt="CAPTCHA" id="captcha_image">
    </div>

    <div>
        <label for="captcha">Enter CAPTCHA:</label>
        <input type="text" name="captcha" id="captcha" required>
    </div>

    <div>
        <button type="button" id="reroll">Reload CAPTCHA</button>
    </div>

    <div>
        <input type="submit" value="Submit">
    </div>
</form>
```

#### Simple CAPTCHA verification

```php
if (isset($_POST['captcha'])) {
    session_start(); // Ensure the session is started
    if ($_POST['captcha'] == $_SESSION["captcha"]) {
        echo "Correct CAPTCHA!";
    } else {
        echo "Invalid CAPTCHA...";
    }
}
```

#### Simple CAPTCHA reroll button

```javascript
const rerollBtn = document.getElementById("reroll");
const captchaImage = document.getElementById("captcha_image");

rerollBtn.addEventListener("click", () => {
    const timestamp = new Date().getTime(); // Generate a unique query parameter to prevent caching
    captchaImage.src = `/captcha.php?rand=${timestamp}`;
});
```
