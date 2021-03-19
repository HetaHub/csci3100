var login= new Vue({
    el: '#login',
    data: {
        username: '',
        password: ''
    },
    methods: {
        processForm: function(){
            //check if database match user input
            console.log(this.username);
            console.log(this.password);
        }
    }
})
var registration= new Vue({
    el: "#registration",
    methods: {
        register: function(){
            window.location.href = "registration.html";
        }
    }
})
var rguest= new Vue({
    el: "#guest",
    methods: {
        guest: function(){
            //go to main page of game
            window.location.href = "main.html";
        }
    }
})