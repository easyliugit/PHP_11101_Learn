<script setup>
import {reactive} from 'vue'

const form=reactive({todo:'',due:'',type:1})
const todos=reactive([]);

const addTodo=()=>{
  todos.push({todo:form.todo,due:form.due,type:form.type})
  console.log(todos)
  form.todo=''
  form.due=''
  form.type=1
  console.log(form)
}

</script>

<template>
<h1 class="header">待辦事項</h1>
<button>新增待辦事項</button>
<div id="addForm">
  事項: <input type="text" v-model="form.todo"><br>
  到期日: <input type="date"  v-model="form.due"><br>
  重要性: <select name="type"  v-model="form.type">
    <option value="1">很重要</option>
    <option value="2">普通</option>
    <option value="3">不重要</option>
  </select><br>
  <button @click="addTodo">新增</button>
</div>
<div>
  <div class="list-item" v-for="todo,idx in todos" :key="idx">
    <div>{{ todo.todo }}</div>
    <div>{{ todo.due }}</div>
    <div>{{ todo.type }}</div>
  </div>
</div>
</template>

<style scoped>
.header{
  text-align: center;
}
.list-item{
  border:1px solid #999;
  display:flex;
  box-shadow: 0 0 3px #ccc;
  margin:0.5rem 2rem;
  padding:0.5rem;
  font-size:1.5rem
}
.list-item > div:nth-child(1){
  width:12rem;
}
.list-item > div:nth-child(2){
  width:10rem;
}
.list-item > div:nth-child(3){
  width:5rem;
}
</style>
