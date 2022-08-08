<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Python web compiler/editor/whatnot</title>
    <link rel="stylesheet" href="./assets/darcula.css">
    <link rel="stylesheet" href="./assets/style.css">
</head>


<body>
    <main>
        <!-- editor wrapper -->
        <div id="editor-wrapper">
            <pre><code id="editor" class="language-python"></code></pre>
        </div>


        <div id="output-wrapper">
            <!-- output -->
            <pre id="stdout"></pre>

            <!-- error output -->
            <pre id="stderr"></pre>
        </div>
    </main>

    <button id="run-button">Run</button>

    <script src="./assets/highlight.min.js"></script>
    <script type="module">
        import {
            CodeJar
        } from './assets/codejar.js';

        (function() {
            let jar = CodeJar(document.querySelector('#editor'), hljs.highlightAll, {
                tab: ' '.repeat(4), // default is '\t'
                indentOn: /[(\[]$/, // default is /{$/
            })

            // i'm not good at documenting, but it's just simple javascript code
            document.querySelector('button#run-button').addEventListener('click', function(e) {
                let thisButton = this
                thisButton.innerText = '...'

                let body = new FormData();
                body.append('code', jar.toString())

                fetch('runner.php', {
                        method: 'POST',
                        body: body
                    })
                    .then(res => res.json())
                    .then(res => {
                        let output = JSON.parse(res)
                        document.querySelector('pre#stdout').innerText = output['stdout']
                        document.querySelector('pre#stderr').innerText = output['stderr']
                    })
                    .catch(error => {
                        console.error(error)
                        alert('Error')
                    }).finally(() => {
                        thisButton.innerText = 'Run'
                    })
            })
        })()
    </script>
</body>

</html>