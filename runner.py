import subprocess
import json

# execute code
out = subprocess.run(["py", "main.py"], capture_output=True)

# store outputs
ret = {
    'stdout': out.stdout.decode('utf-8'),
    'stderr': out.stderr.decode('utf-8'),
    'return': out.returncode
}

# encoded to json for easy-parsing with javascript
# once it is returned from `runner.php` file
print(json.dumps(ret, indent=4))
