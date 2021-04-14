var login= new Vue({
    el: '#comment',
    data: {
        comment: ''
    },
    methods: {
        processForm: function(){
            axios.get('ajaxfile.php', {
                params: {
                  func: "comment",
                  comment: this.comment
                }
             })
             .catch(function (error) {
                console.log(error);
             });
            
            window.location.href = "main.html";
        }
    }
})