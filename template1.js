var data = readJSON('./info.JSON')
data = JSON.parse(data)


function readJSON(file) {
    var request = new XMLHttpRequest();
    request.open('GET', file, false);
    request.send(null);
    if (request.status == 200)
        return request.responseText;
};

console.log(data)

var app = new Vue({
    el: '#app',
    data: {
      projects: data.projects,
      index : 0,
      data : data
    },
    methods : {
        changeModal(num) {
            console.log(num)
            this.index = num
        }
    }
  })