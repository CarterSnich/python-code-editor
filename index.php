<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="darcula.css">

    <style>
        body {
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        main {
            width: calc(100vw - 5rem);
            height: calc(100vh - 5rem);
            display: grid;
            grid-template-columns: 50% 50%;
            gap: 1.25rem
        }

        pre {
            margin: 0;
        }

        #editor-wrapper,
        #editor-wrapper>pre,
        #editor-wrapper>pre>code {
            height: 100%;
        }

        #output-wrapper {
            display: flex;
            flex-flow: column;
            gap: 1.25rem;
        }



        pre#stdout {
            color: #00ff00;
            background-color: black;
            padding: 1.25rem;
        }

        pre#stderr {
            color: #ff0000;
            background-color: black;
            padding: 1.25rem;
        }

        #run-button {
            position: absolute;
            right: 1.25rem;
            top: .75rem;
            font-size: medium;
        }
    </style>
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

    <script src="highlight.min.js"></script>
    <script type="module">
        import {
            CodeJar
        } from './codejar.js';

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
                        let output = JSON.parse(res.output)
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