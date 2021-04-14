var register= new Vue({
    el: '#register',
    data: {
        username: '',
        password: '',
        repassword: '',
    },
    methods: {
        processForm: function(){
            if(this.password!=this.repassword){
                alert("password confirmation failed");
                Console.log("hi");
                window.location.href = "main.php";
            }
            else{
                //store into databas
                //this.record(this.username, this.password);
                axios.get('ajaxfile.php', {
                    params: {
                      func: "register",
                      username: this.username,
                      password: this.password
                    }
                 })
                 .catch(function (error) {
                    console.log(error);
                 });
                
                window.location.href = "main.php";
            }
        },
        /*record: function(){
            axios.get('ajaxfile.php', {
                params: {
                  function: "register",
                  username: this.username,
                  password: this.password
                }
             })
             .catch(function (error) {
                console.log(error);
             });
        }*/
    }
})
