$(function() {
    //alert('c');
    var user = {};

    user.ajax = {
        get_list: function(s, e, cb){
            var url = '/brands/save',
                params = {
                    s: s,
                    e: e
                };

            app.ajax(url, params, function(err, data){
                err ? cb(err) : cb(null, data);
            });
        }
    };


});
