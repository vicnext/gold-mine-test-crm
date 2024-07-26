function customValidate(rules, module, record, field, value) {
    $.ajax({
        url: 'index.php?entryPoint=validate',
        async: false,
        data: {
            rules: rules,
            module: module,
            record: record,
            field: field,
            value: value,
        },
    }).done(function(response) {
        result = response;
    }).fail(function(jqXHR, textStatus, errorThrown) {
        result = jqXHR.responseText;
        console.log(result);
    });

    return result;
}

   //const res = await fetch("https://jsonplaceholder.typicode.com/todos/1");
    //console.log(res);
   // const data = await res.json();
    
    
    //const res = await fetch("https://jsonplaceholder.typicode.com/todos/1", {/* options here */});
    
    
    //const data = await $.ajax({url: "https://jsonplaceholder.typicode.com/todos/1"});
    
    
    /*
console.log("Some code before");

const res = await fetch("https://jsonplaceholder.typicode.com/todos/1", {});
const data = await res.json();
  
console.log(data);
console.log("Some code after that uses data");
    */
  //debugger;
    /*
const someFunction = async () => { // Make your function async
  
  //let data;

  console.log("Some code before...");

const data = await fetch("https://jsonplaceholder.typicode.com/todos/1");
  
  console.log(data);
  console.log("Some code that uses data...");
  alert(777);
  debugger;
  return data;
};

var data = await someFunction();
    
$res = data.type;

console.log(data);

  alert(888);
  debugger;
  */
    /*
  debugger;
    $.ajax({
        url: 'index?module=UN_Mining&action=validate',
        async: false,
        data: {
            rules: rules,
            module: module,
            field: field,
            value: value,
        },
    }).done(function(response) {
        if (response.status) {
            result = response.message;
        } else {
            result = '';
        }
    }).fail(function(jqXHR, textStatus, errorThrown) {
        result = jqXHR.responseText;
        console.log(result);
    });
*/
    //result = '5555555';

