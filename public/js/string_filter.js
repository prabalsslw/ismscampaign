function filterSlang(msg)
{
    var msgs = msg.toLowerCase();
    res = msgs.split(" ");
    count = res.length;
    string_list = ["sexual","adult","lottery","sex","motherfucker","fucker","bitch","motherchod","shala","fuck","kuttarbacha","kutta","khanki","magi","bainchod","penis","tui","madarchod","beyadob"];
    for(i = 0; i < count; i++)
    {
        for(j = 0 ; j < string_list.length ; j++)
        {
            if(res[i] == string_list[j])
            {
                alert("sd");
                return false;
            }
            else
            {
                return true;
            }
        }
    }
}