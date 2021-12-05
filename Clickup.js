var request = new XMLHttpRequest();

request.open('GET', 'https://api.clickup.com/api/v2/task/9hz/time_in_status/');

request.setRequestHeader('Authorization', '"CMA836D9B51V0PU8KMSQYQQFTUT3YQJ"');
request.setRequestHeader('Content-Type', 'application/json');

request.onreadystatechange = function () {
  if (this.readyState === 4) {
    console.log('Status:', this.status);
    console.log('Headers:', this.getAllResponseHeaders());
    console.log('Body:', this.responseText);
  }
};

request.send();