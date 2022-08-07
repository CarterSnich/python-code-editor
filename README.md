# Python web compiler

## Files

You can edit these files

- `index.php` - the pag, obviously
- `runner.php` - accepts request, executes helper script, and returns command output
- `main.py` - output file of the code
- `runner.py` - helper script to run and handle command outputs, the actual file that executes the code

**DO NOT TOUCH THESE FILES**

- `codejar.js` - code editor module
- `highlight.min.js` - code highlighter module
- `dracula.css` - code highlighter theme styling

## How to setup

Just clone the repo and execute `php -S 127.0.0.1:8000`.

## Dependencies

- [`codejar`](https://github.com/antonmedv/codejar)
- [`highlight.js`](https://highlightjs.org/)
