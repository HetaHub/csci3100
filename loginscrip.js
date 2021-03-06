var login= new Vue({
    el: '#login',
    data: {
        username: '',
        password: ''
    },
    methods: {
        record: function(){
            axios.get('ajaxfile.php', {
                params: {
                  func: "login",
                  username: this.username,
                  password: this.password
                }
             })
             .then(function (response) {
                this.users = response.data;
                if(response.data==null){
                    alert("Wrong username or password");
                    window.location.href = "main.php"
                }
                else {
                    document.cookie = "username=" + this.username; 
                }
             })
             .catch(function (error) {
                console.log(error);
             });
        }
    }
})


/*
var rguest= new Vue({
    el: "#guest",
    methods: {
        guest: function(){
            //go to main page of game
            window.location.href = "main.html";
        }
    }
})
*/
