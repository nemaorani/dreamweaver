const express = require('express');
const exphbs  = require('express-handlebars');

const PizzaCart = require('./pizzaCartFactory')

const pizzaCart = PizzaCart();

var session = require('express-session')

var bodyParser = require('body-parser')

const app = express();
const PORT =  process.env.PORT || 3017;

// enable the req.body object - to allow us to use HTML forms
app.use(express.json());
app.use(express.urlencoded({ extended: false }));

// parse application/x-www-form-urlencoded
app.use(bodyParser.urlencoded({ extended: false }))
 
// parse application/json
app.use(bodyParser.json())

// enable the static folder...
app.use(express.static('public'));

// add more middleware to allow for templating support

app.engine('handlebars', exphbs());
app.set('view engine', 'handlebars');

// Use the http-	session middleware
app.use(session({ secret: 'keyboard cat', cookie: { maxAge: 60000 }}))


let counter = 0;

app.get('/', function(req, res) {

//	console.log(req.session)
//	console.log(pizzaCart.customerIdea())
	console.log(pizzaCart.getMessage())
	res.render('index', {
	  
		smallPizzaTotal: pizzaCart.smallPizzaTotal(),
		mediumPizzaTotal: pizzaCart.mediumPizzaTotal(),
		largePizzaTotal: pizzaCart.largePizzaTotal(),
		grandTotal: pizzaCart.grandTotalPizza(),
		userID: pizzaCart.customerIdea(),
		paymentMsg: pizzaCart.getMessage() ,

	});
});

app.post('/action', function(req, res) {
	pizzaCart.buySmallPizza(req.body);
	res.redirect('/');
});

app.get('/buy-small',function(req, res){
//console.log('Our App');
pizzaCart.buySmallPizza(req.body);
res.redirect('/')
})

app.get('/buy-medium',function(req, res){
	pizzaCart.buyMediumPizza(req.body);
	res.redirect('/')
})

app.get('/buy-large',function(req, res){
	pizzaCart.buyLargePizza(req.body);
	res.redirect('/')
})

app.get('/add-small',function(req, res){
	pizzaCart.addSmallPizza(req.body);
	res.redirect('/')
})

app.get('/add-medium',function(req, res){
	pizzaCart.addMediumPizza(req.body);
	res.redirect('/')
})

app.get('/add-large',function(req, res){
	pizzaCart.addLargePizza(req.body);
	res.redirect('/')
})

app.get('/minus-small',function(req, res){
	pizzaCart.minusSmallPizza(req.body);
	res.redirect('/')
})

app.get('/minus-medium',function(req, res){
	pizzaCart.minusMediumPizza(req.body);
	res.redirect('/')
})

app.get('/minus-large',function(req, res){
	pizzaCart.minusLargePizza(req.body);
	res.redirect('/')
})

app.get('/info',function(req, res){
	res.render('info');
//	res.redirect('/')
})

app.get('/count', function(req, res) {
	res.render('pizza', {
		counter
	});

});

app.post('/count', function(req, res) {
	counter++;
	res.redirect('/count')
});


 //app.get('/', function(req, res) {

// 	console.log(pizzaCart.customerIdea())

//  	res.render('pizza', {
//  		userID: pizzaCart.customerIdea(),
	
// 	});
//  });


app.get('/', function(req, res) {

	//console.log(pizzaCart.smallPizzaTotal())
	console.log(pizzaCart.customerIdea())
	res.render('pizza', {
	  
		userID: pizzaCart.customerIdea()

	});
});


app.get('/update-userID',function(req, res){
	//console.log('Our App')
	pizzaCart.customerIds(req.body);
	
	res.redirect('/')
})

app.get('/count', function(req, res) {
	res.render('pizza', {
		reminders
	});
});

app.post('/msg', function(req, res) {
	
	pizzaCart.payVal(req.body);
	res.redirect('/');
});

app.get('/orders', function(req, res) {
	//var orders = getOrders()
	console.log(pizzaCart.getOrders())
	console.log(req.body)
	res.render('orders', {
	//	orders	
	orders: pizzaCart.getOrders(),
	grandTotal: pizzaCart.grandTotalPizza(),
	order2: pizzaCart.getUpdtOrders(),
	order3: pizzaCart.getCollectOrders()
	})

});

app.get('/create-order', function(req, res) {
	
	pizzaCart.createOrder(req.body)
//	console.log(req.body)
	res.redirect('/')

});
app.get('/update-order', function(req, res) {
	
	pizzaCart.updtOrder(req.body)
	res.redirect('orders')
});

app.get('/collect-order', function(req, res) {
	
	pizzaCart. collectOrder(req.body)
	res.redirect('orders')
});


app.get('/login', function(req, res) {
	
	res.render('login')
});


















// app.get('/',function(req, res){
    

//    res.render('index', {
       
//    settings: settingsBill.getSettings(),
//    totals: settingsBill.totals(),
//    textColor:settingsBill.getTextColour()
//   });


// });





// app.get('/buy-small',function(req, res){
// 	//console.log('Our App');
// 	pizzaCart.buySmallPizza(req.body);
// 	res.redirect('/')
// 	})


// start  the server and start listening for HTTP request on the PORT number specified...
app.listen(PORT, function() {
	console.log(`App started on port ${PORT}`)
});
