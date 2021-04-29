var CardTypes = [
    {
      name: "Science Laboratory Building",
      image: "https://external-content.duckduckgo.com/iu/?u=https%3A%2F%2Flive.staticflickr.com%2F2301%2F2203003153_d993125329_b.jpg&f=1&nofb=1",
      info: "slb"
    },
    {
      name: "milestones",
      image: "https://external-content.duckduckgo.com/iu/?u=http%3A%2F%2Fwww.50.cuhk.edu.hk%2Fcu50%2Fsites%2Fdefault%2Ffiles%2Fimages%2Fmilestones%2F20.jpg&f=1&nofb=1",
      info: "m"
    },
    {
      name: "lib",
      image: "https://external-content.duckduckgo.com/iu/?u=https%3A%2F%2Fwww.lib.cuhk.edu.hk%2Fsites%2Fcuhk%2Ffiles%2Fpage%2FLIb%2520building_0.jpg&f=1&nofb=1",
      info: "l"
    },
    {
      name: "school of architechture",
      image: "https://i.imgur.com/eyXwyDy.png",
      info: "soa"
    },
    {
      name: "sui loong pao building",
      image: "https://i.imgur.com/IZ4mfIk.png",
      info: "slpb"
    },
    {
      name: "lks medical science building",
      image: "https://www.med.cuhk.edu.hk/f/facilities/51/1024p638/5a39e98d3f42d.jpg",
      info: "lks"
    },
	{
      name: "Science Laboratory Building",
      image: "https://i.imgur.com/7hNSltW.png",
      info: "slb"
    },
	{
      name: "milestones",
      image: "https://i.imgur.com/0Pb3aJD.png",
      info: "m"
    },
    {
      name: "lib",
      image: "https://i.imgur.com/2XFXRmL.png",
      info: "l"
    },
    {
      name: "school of architechture",
      image: "https://i.imgur.com/OXmx2zV.png",
      info: "soa"
    },
    {
      name: "sui loong pao building",
      image: "https://i.imgur.com/kZDMeoR.png",
      info: "slpb"
    },
    {
      name: "lks medical science building",
      image: "https://i.imgur.com/stojzUi.png",
      info: "lks"
    }
  ];
  
  var shuffleCards = function shuffleCards() {
	var cards;
    cards = [].concat(_.cloneDeep(CardTypes));
    return _.shuffle(cards);
  };
  
  new Vue({
    el: "#app",
  
    data: {
      showSplash: false,
      cards: [],
      started: false,
      startTime: 0,
      turns: 0,
      flipBackTimer: null,
      timer: null,
      time: "--:--",
      score: 0
    },
  
    methods: {
      resetGame: function resetGame() {
        this.showSplash = false;
        var cards = shuffleCards();
        this.turns = 0;
        this.score = 0;
        this.started = false;
        this.startTime = 0;
  
        _.each(cards, function (card) {
          card.flipped = false;
          card.found = false;
        });
  
        this.cards = cards;
      },
	    
      send: function(){
		  var sss=this.score;
		  var usernameCookie = getCookie("username");
		  if (usernameCookie == "") {
		     alert('Currently not logged in. Please log in first.');
	      	  }
		  else {
				$.ajax({
				  url: 'sendscore.php',
				  type: 'post',
				  data: 'score='+sss+'&username='+usernameCookie,
				  success: function(output) 
				  {
					  alert('Submission successful! '+output);
				  }, error: function()
				  {
					  alert('Something went wrong! Submission failed.');
				  }
			   });
		  }
		  this.resetGame();
      },
  
      closeModal: function closeModal() {
        $("#info").fadeOut("fast");
      },
  
      showModal: function showModal() {
        $("#info").fadeIn("slow");
      },
  
      flippedCards: function flippedCards() {
        return _.filter(this.cards, function (card) { return card.flipped; });
      },
  
      sameFlippedCard: function sameFlippedCard() {
        var flippedCards = this.flippedCards();
        if (flippedCards.length == 2) {
          if (flippedCards[0].name == flippedCards[1].name)
            return true;
        }
      },
  
      setCardFounds: function setCardFounds() {
        _.each(this.cards, function (card) {
          if (card.flipped)
            card.found = true;
        });
      },
  
      checkAllFound: function checkAllFound() {
        var foundCards = _.filter(this.cards, function (card) { return card.found; });
        if (foundCards.length == this.cards.length)
          return true;
      },
  
      startGame: function startGame() {
        var _this = this;
        this.started = true;
        this.startTime = moment();
  
        this.timer = setInterval(function () {
          _this.updateScore()
          _this.time = moment(moment().diff(_this.startTime)).format("mm:ss");
        }, 1000);
      },
  
      updateScore: function updateScore() {
        var elapsedTime = moment().diff(this.startTime, 'seconds')
        var score = 2000 - elapsedTime * 5 - this.turns * 20
        this.score = Math.max(score, 0)
      },
  
      finishGame: function finishGame() {
        this.started = false;
        clearInterval(this.timer);
        this.updateScore();
        this.showSplash = true;
      },
  
      flipCard: function flipCard(card) {
        this.updateScore();
        var _this2 = this;
        if (card.found || card.flipped) return;
  
        if (!this.started) {
          this.startGame();
        }
  
        var flipCount = this.flippedCards().length;
        if (flipCount == 0) {
          card.flipped = !card.flipped;
        } else
          if (flipCount == 1) {
            card.flipped = !card.flipped;
            this.turns += 1;
  
            if (this.sameFlippedCard()) {
              // Match!
  
              this.flipBackTimer = setTimeout(function () {
                _this2.clearFlipBackTimer();
                _this2.setCardFounds();
                _this2.clearFlips();
  
                if (_this2.checkAllFound()) {
                  _this2.finishGame();
                }
  
              }, 200);
            } else {
              // Wrong match
              this.flipBackTimer = setTimeout(function () {
                _this2.clearFlipBackTimer();
                _this2.clearFlips();
              }, 1000);
            }
          }
      },
  
      clearFlips: function clearFlips() {
        _.map(this.cards, function (card) { return card.flipped = false; });
      },
  
      clearFlipBackTimer: function clearFlipBackTimer() {
        clearTimeout(this.flipBackTimer);
        this.flipBackTimer = null;
      }
    },
  
    created: function created() {
      this.resetGame();
    }
  });
