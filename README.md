# Python web compiler/editor/whatnot

## Files

- `index.php` - the page, obviously
- `runner.php` - accepts request, and executes helper script, and returns command output
- `main.py` - output file of the code. this is in `.gitignore` but is generated once you run a code
- `runner.py` - helper script to run and handle command outputs. the actual file that executes the code
- `assets/*` - libraries/dependencies folder

## How to setup

Just clone the repo and execute `php -S 127.0.0.1:8000`.

## Dependencies

- [`codejar`](https://github.com/antonmedv/codejar)
- [`highlight.js`](https://highlightjs.org/)
