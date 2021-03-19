var login= new Vue({
    el: '#login',
    data: {
        username: '',
        password: '',
        repassword: '',
    },
    methods: {
        processForm: function(){
            if(this.password!=this.repassword){
                alert("password confirmation failed");
                window.location.href = "registration.html";
            }
            else{
                //store into databas
                window.location.href = "login.html";
            }
        }
    }
})