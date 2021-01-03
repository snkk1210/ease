var editor = CodeMirror.fromTextArea(document.getElementById("txt-editor"),
{
    mode: 'YAML',
    theme: 'lesser-dark',
    tabMode: 'shift',
    lineNumbers: true,
    matchBrackets: true,
    indentUnit: 2,
    indentWithTabs: true,
    enterMode: 'keep',
    lineWrapping: true,
});
var editor = CodeMirror.fromTextArea(document.getElementById("var-editor"),
{
    mode: 'YAML',
    theme: 'lesser-dark',
    tabMode: 'shift',
    lineNumbers: true,
    matchBrackets: true,
    indentUnit: 2,
    indentWithTabs: true,
    enterMode: 'keep',
    lineWrapping: true,
});