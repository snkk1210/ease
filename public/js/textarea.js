var editor = CodeMirror.fromTextArea(document.getElementById("txt-editor"),
{
    mode: 'YAML',
    theme: 'lesser-dark',
    lineNumbers: true,
    /*
    tabMode: 'shift',
    matchBrackets: true,
    indentUnit: 2,
    indentWithTabs: true,
    enterMode: 'keep',
    lineWrapping: true,
    */
});
var editor = CodeMirror.fromTextArea(document.getElementById("var-editor"),
{
    mode: 'YAML',
    theme: 'lesser-dark',
    lineNumbers: true,
    /*
    tabMode: 'shift',
    matchBrackets: true,
    indentUnit: 2,
    indentWithTabs: true,
    enterMode: 'keep',
    lineWrapping: true,
    */
});