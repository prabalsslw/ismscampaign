function textCounter(field, maxlimit)
{
    var extraChars = 0;
    var msgCount = 0;
    for (var i = 0; (i < field.value.length); i++) 
    {
    // alert(field.value.charAt(i));
    // alert(field.value.charCodeAt(i));

        if ((field.value.charAt(i) >= '0') && (field.value.charAt(i) <= '9')) {
        }
        else if ((field.value.charAt(i) >= 'A') && (field.value.charAt(i) <= 'Z')) {
        }
        else if ((field.value.charAt(i) >= 'a') && (field.value.charAt(i) <= 'z')) {
        }
        else if (field.value.charAt(i) == '@') {
        }
        else if (field.value.charAt(i) == '?') {
        }
        else if (field.value.charAt(i) == '$') {
        }
        else if (field.value.charAt(i) == '?') {
        }
        else if (field.value.charCodeAt(i) == 0xE8) {
        }
        else if (field.value.charCodeAt(i) == 0xE9) {
        }
        else if (field.value.charCodeAt(i) == 0xF9) {
        }
        else if (field.value.charCodeAt(i) == 0xEC) {
        }
        else if (field.value.charCodeAt(i) == 0xF2) {
        }
        else if (field.value.charCodeAt(i) == 0xC7) {
        }
        else if (field.value.charAt(i) == '\r') {
        }
        else if (field.value.charAt(i) == '\n') {
            if (navigator.appName == "Netscape"){
            extraChars++;
            }
        }
        else if (field.value.charCodeAt(i) == 0xD8) {
        }
        else if (field.value.charCodeAt(i) == 0xF8) {
        }
        else if (field.value.charCodeAt(i) == 0xC5) {
        }
        else if (field.value.charCodeAt(i) == 0xE5) {
        }
        else if (field.value.charCodeAt(i) == 0x394) {
        }
        else if (field.value.charAt(i) == '_') {
        }
        else if (field.value.charCodeAt(i) == 0x3A6) {
        }
        else if (field.value.charCodeAt(i) == 0x393) {
        }
        else if (field.value.charCodeAt(i) == 0x39B) {
        }
        else if (field.value.charCodeAt(i) == 0x3A9) {
        }
        else if (field.value.charCodeAt(i) == 0x3A0) {
        }
        else if (field.value.charCodeAt(i) == 0x3A8) {
        }
        else if (field.value.charCodeAt(i) == 0x3A3) {
        }
        else if (field.value.charCodeAt(i) == 0x398) {
        }
        else if (field.value.charCodeAt(i) == 0x39E) {
        }
        else if (field.value.charCodeAt(i) == 0xC6) {
        }
        else if (field.value.charCodeAt(i) == 0xE6) {
        }
        else if (field.value.charCodeAt(i) == 0xDF) {
        }
        else if (field.value.charCodeAt(i) == 0xC9) {
        }
        else if (field.value.charAt(i) == ' ') {
        }
        else if (field.value.charAt(i) == '!') {
        }
        else if (field.value.charAt(i) == '\"') {
        }
        else if (field.value.charAt(i) == '#') {
        }
        else if (field.value.charCodeAt(i) == 0xA4) {
        }
        else if (field.value.charAt(i) == '%') {
        }
        else if (field.value.charAt(i) == '&') {
        }
        else if (field.value.charAt(i) == '\'') {
        }
        else if (field.value.charAt(i) == '(') {
        }
        else if (field.value.charAt(i) == ')') {
        }
        else if (field.value.charAt(i) == '*') {
        }
        else if (field.value.charAt(i) == '+') {
        }
        else if (field.value.charAt(i) == ',') {
        }
        else if (field.value.charAt(i) == '-') {
        }
        else if (field.value.charAt(i) == '.') {
        }
        else if (field.value.charAt(i) == '/') {
        }
        else if (field.value.charAt(i) == ':') {
        }
        else if (field.value.charAt(i) == ';') {
        }
        else if (field.value.charAt(i) == '<') {
        }
        else if (field.value.charAt(i) == '=') {
        }
        else if (field.value.charAt(i) == '>') {
        }
        else if (field.value.charAt(i) == '?') {
        }
        else if (field.value.charCodeAt(i) == 0xA1) {
        }
        else if (field.value.charCodeAt(i) == 0xC4) {
        }
        else if (field.value.charCodeAt(i) == 0xD6) {
        }
        else if (field.value.charCodeAt(i) == 0xD1) {
        }
        else if (field.value.charCodeAt(i) == 0xDC) {
        }
        else if (field.value.charCodeAt(i) == 0xA7) {
        }
        else if (field.value.charCodeAt(i) == 0xBF) {
        }
        else if (field.value.charCodeAt(i) == 0xE4) {
        }
        else if (field.value.charCodeAt(i) == 0xF6) {
        }
        else if (field.value.charCodeAt(i) == 0xF1) {
        }
        else if (field.value.charCodeAt(i) == 0xFC) {
        }
        else if (field.value.charCodeAt(i) == 0xE0) {
        }
        else if (field.value.charCodeAt(i) == 0x391) {
        }
        else if (field.value.charCodeAt(i) == 0x392) {
        }
        else if (field.value.charCodeAt(i) == 0x395) {
        }
        else if (field.value.charCodeAt(i) == 0x396) {
        }
        else if (field.value.charCodeAt(i) == 0x397) {
        }
        else if (field.value.charCodeAt(i) == 0x399) {
        }
        else if (field.value.charCodeAt(i) == 0x39A) {
        }
        else if (field.value.charCodeAt(i) == 0x39C) {
        }
        else if (field.value.charCodeAt(i) == 0x39D) {
        }
        else if (field.value.charCodeAt(i) == 0x39F) {
        }
        else if (field.value.charCodeAt(i) == 0x3A1) {
        }
        else if (field.value.charCodeAt(i) == 0x3A4) {
        }
        else if (field.value.charCodeAt(i) == 0x3A5) {
        }
        else if (field.value.charCodeAt(i) == 0x3A7) {
        }
        else if (field.value.charAt(i) == '^') {
             extraChars++;
        }
        else if (field.value.charAt(i) == '{') {
             extraChars++;
        }
        else if (field.value.charAt(i) == '}') {
             extraChars++;
        }
        else if (field.value.charAt(i) == '\\') {
             extraChars++;
        }
        else if (field.value.charAt(i) == '[') {
             extraChars++;
        }
        else if (field.value.charAt(i) == '~') {
             extraChars++;
        }
        else if (field.value.charAt(i) == ']') {
             extraChars++;
        }
        else if (field.value.charAt(i) == '|') {
             extraChars++;
        }
        else if (field.value.charCodeAt(i) == 0x20AC) {
             extraChars++;
        }
        else {
             //unicodeFlag = 1;
        }   
    }
    return extraChars;
} 
    
// $('#message').on('keyup',function(){  
//     extra = textCounter(document.camp.message, $("#message").val().length);
//     total = $("#message").val().length;
//     document.getElementById('msglength').value = total;
//     // $('#msglength').html(total);
//     document.getElementById('specialchar').value = extra;
//     // $('#specialchar').html(extra);

//     if(total>160)
//     {
//         total=Math.ceil(total/153);
//         // $('#msgcount').val(total);
//         // $('#msgcount').html(total);
//         document.getElementById('msgcount').value = total;
//     }
//     else if(total>0)
//     {
//         // $('#msgcount').val(1);
//         // $('#msgcount').html(1)
//         document.getElementById('msgcount').value = "1";
//     }
//     else
//         // $('#msgcount').val(0);
//         // $('#msgcount').html(0)
//         document.getElementById('msgcount').value = "0";
    
// });

// $('#message').on('keyup',function(){         
//     //if($("#msglength").val()==0 || $("#msglength").val().substring(0,1)=="-")
//     //  $("#message").val($("#message").val().substring(0,160));            
//     //$('#msglength').val(160-($("#message").val().length));
//     total=$("#message").val().length;
//     document.getElementById('msglength').value = total;
//     document.getElementById('specialchar').value = extra;

//     if(total>70)
//     {
//         total=Math.ceil(total/67);
//         document.getElementById('msgcount').value = total;
//     }
//     else if(total>0)
//     {
//         document.getElementById('msgcount').value = "1";
//     }
//     else
//         document.getElementById('msgcount').value = "0";
// });