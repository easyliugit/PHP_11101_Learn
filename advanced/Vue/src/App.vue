<script setup>
  import {ref,reactive,watch} from 'vue'
  import ListItem from './components/ListItem.vue';
  const form=reactive({todo:'',due:'',type:1})
  const todos=reactive([]);
  const show=ref(false)
  const addTodo=()=>{
    show.value=false
    todos.push({todo:form.todo,due:form.due,type:form.type})
    form.todo=''
    form.due=''
    form.type=1
  }
  const delTodo=(idx)=>{
    todos.splice(idx,1)
    console.log('刪除',idx)
  }
  </script>
  
  <template>
  <h1 class="header">待辦事項</h1>
  <button @click="show=true">新增待辦事項</button>
  <div id="addForm" v-if="show">
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
   <!-- v-for="todo,idx in todos" :key="idx" ref="items" -->
   <ListItem v-for="todo,idx in todos" :key="idx" :todo="todo" @delTodo="delTodo(idx)"/>
  </div>
  </template>
  
  <style scoped>
  .header{
    text-align: center;
  }
  </style>