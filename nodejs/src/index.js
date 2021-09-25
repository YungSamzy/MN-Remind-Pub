const axios = require("axios");
const cheerio = require("cheerio");
const _ = require("lodash");
const fs = require("fs");
const path = require("path");
const { exit } = require("process");
function isDateInThisWeek(date) {
  const todayObj = new Date();
  const todayDate = todayObj.getDate();
  const todayDay = todayObj.getDay();

  // get first date of week
  const firstDayOfWeek = new Date(todayObj.setDate(todayDate - todayDay));

  // get last date of week
  const lastDayOfWeek = new Date(firstDayOfWeek);
  lastDayOfWeek.setDate(lastDayOfWeek.getDate() + 13);

  // if date is equal or within the first and last dates of the week
  return date >= firstDayOfWeek && date <= lastDayOfWeek;
}

function getSeasons() {
  axios.get('http://localhost/request.php')
  .then(function (response) {
    // handle success
    //var testSuite = response.data['title'];
    //console.log(testSuite);
    //console.log(response.data[0].title);
    //console.log(response.data[1].title);
    var title1 = response.data[0].title;
    var title2 = response.data[1].title;
    var title3 = response.data[2].title;
    var title4 = response.data[3].title;
    var title5 = response.data[4].title;
    var date1 = new Date(response.data[0].date);
    var date2 = new Date(response.data[1].date);
    var date3 = new Date(response.data[2].date);
    var date4 = new Date(response.data[3].date);
    var date5 = new Date(response.data[4].date);
    /*console.log(title1 + " | " + date1);
    console.log(title2 + " | " + date2);
    console.log(title3 + " | " + date3);
    console.log(title4 + " | " + date4);
    console.log(title5 + " | " + date5); */
    /*
    for(var i=0; i<rows.length; i++){
      check(rows[i].number, title1);
}
    if (isDateInThisWeek(date1))
    {
      send(title1, date1);
    }
    if (isDateInThisWeek(date2))
    {
      send(title2, date2);
    }
    if (isDateInThisWeek(date3))
    {
      send(title3, date3);
    }
    if (isDateInThisWeek(date4))
    {
      send(title4, date4);
    }
    if (isDateInThisWeek(date5))
    {
      send(title5, date5);
    }*/
    /*NEED THIS
        for(var i=0; i<response.data.length; i++){
      if (isDateInThisWeek(new Date(response.data[i].date))){
      
      }
      */
      const mysql = require('mysql');
      const connection = mysql.createConnection({
        host: 'host',
        user: 'user',
        password: 'password',
        database: 'hunting'
      });
      connection.connect((err) => {
        if (err) throw err;
      });
      connection.query(`SELECT number FROM numbers`, (err,rows) => {
        if(err) throw err;
        for(var i=0; i<rows.length; i++){
          for(var j=0; j<response.data.length; j++){
            if (response.data[j].date.indexOf('-') !== 1)
            {
                if (isDateInThisWeek(new Date(response.data[j].date))){
                  if(checkcheck){ //TEMP
                    //send(rows[i].number, response.data[j].title, new Date(response.data[j].date), `https://www.dnr.state.mn.us${response.data[j].link}`);
                    console.log(`${rows[i].number} | Hey! Just a heads up, ${response.data[j].title} starts on ${weird_to_reg_date(new Date(response.data[j].date))}. Check out more here: https://www.dnr.state.mn.us${response.data[j].link}`);
                  }
                }
            }
            /*
            */
          }
        }
      });
  })
  .catch(function (error) {
    // handle error
    console.log(error);
  })
  .then(function () {
    // always executed
  });
}
function checknumber(number) {
  axios.get(`http://localhost/number.php?n=${number}`)
  .then(function (response) {

  })
  .catch(function (error) {
    // handle error
    console.log(error);
  })
  .then(function () {
    // always executed
  });
}

function weird_to_reg_date(date)
{
  return ((date.getMonth() > 8) ? (date.getMonth() + 1) : ('0' + (date.getMonth() + 1))) + '/' + ((date.getDate() > 9) ? date.getDate() : ('0' + date.getDate())) + '/' + date.getFullYear();
}

function send(number, event_title, event_date, link) {
  //console.log(`${number} | Hey! Just a heads up, ${event_title} starts on ${weird_to_reg_date(new Date(event_date))}. Check out more here: ${link}`);
  finish(number, event_title);
  const accountSid = 'accountSid'; // Your Account SID from www.twilio.com/console
const authToken = 'authToken'; // Your Auth Token from www.twilio.com/console
const twilio = require('twilio');
const client = new twilio(accountSid, authToken);
client.messages
  .create({
    body: `Hey! Just a heads up, ${event_title} starts on ${weird_to_reg_date(new Date(event_date))}. Check out more here: ${link}`,
    to: number, // Text this number
    from: 'number', // From a valid Twilio number
  })
  .then((message) => console.log(message.sid));
}
function finish(number, event)
{
  const mysql = require('mysql');
  const connection = mysql.createConnection({
    host: 'host',
    user: 'user',
    password: 'password',
    database: 'hunting'
  });
  connection.connect((err) => {
    if (err) throw err;
  });
  connection.query(`SELECT events FROM numbers WHERE number = ${number}`, (err,result) => {
    if(err) throw err;
    var events = result[0].events;
    if (events == "")
    {
      connection.query(`UPDATE numbers SET events='${event}' WHERE number = '${number}'`, (err1,result1) => {
        if(err1) throw err1;
      });
    }
    else
    {
      var event1 = `${events},${event}`;
      connection.query(`UPDATE numbers SET events='${event1}' WHERE number = '${number}'`, (err12,result12) => {
        if(err12) throw err12;
      });
    }
  });
}
function getphones()
{
  const mysql = require('mysql');
  const connection = mysql.createConnection({
    host: 'host',
    user: 'user',
    password: 'password',
    database: 'hunting'
  });
  connection.connect((err) => {
    if (err) throw err;
  });
  connection.query(`SELECT number FROM numbers`, (err,rows) => {
    if(err) throw err;
    return rows;
  });
}
function check(number, event, callback){
  const mysql = require('mysql');
  const connection = mysql.createConnection({
    host: 'host',
    user: 'user',
    password: 'password',
    database: 'hunting'
  });
  connection.connect((err) => {
    if (err) throw err;
  });
  connection.query(`SELECT events FROM numbers WHERE number = ${number}`, (err,rows) => {
    if(err) throw err;
    if (rows[0].events.indexOf(event) !== -1){
      console.log(`${number} has already been texted about ${event}.`);
      return callback(true, true);
    }else
    {
      return callback(false, false);
    }
  });
}
function test()
{
return true;
}
function start() {
  //setInterval(() => getSeasons(), 5000);
  /*let check2 = check('{REDACTED}', 'testevent12');
  if(check2 == 1) //WORK ON CHECK
  {
    console.log('not been texted');
    exit();
  }
  if(check2 == -1)
  {
    console.log('has been texted');
    exit();
  }*/
  getSeasons();
}

start();
