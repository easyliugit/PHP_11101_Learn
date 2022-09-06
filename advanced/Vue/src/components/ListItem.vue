<script setup>
    import {ref,reactive} from 'vue'
    defineProps({todo:Object})
    const emits=defineEmits(['delTodo'])
    const item=ref();
    const delTodo=()=>{
        emits('delTodo')
    }
    const editTodo=()=>{
      //console.log(items.value[idx].childNodes)
      item.value.childNodes[0].innerHTML=`<input type='text' v-model=\"form.todo\" value="${item.value.childNodes[0].innerText}">`
      item.value.childNodes[1].innerHTML=`<input type='date' v-model=\"form.due\" value="${item.value.childNodes[1].innerText}">`
      item.value.childNodes[2].innerHTML=`
      <select name="type"  v-model="form.type">
        <option value="1">很重要</option>
        <option value="2">普通</option>
        <option value="3">不重要</option>
      </select>
      `
      let button=document.createElement('button')
      let node=document.createTextNode('OK');
      button.appendChild(node)
      item.value.childNodes[3].remove()
      item.value.childNodes[3].remove()
      item.value.appendChild(button)
    }
    </script>
    <template>
    
    <div class="list-item" ref="item">
        <div>{{ todo.todo }}</div>
        <div>{{ todo.due }}</div>
        <div>{{ todo.type }}</div>
        <button @click="editTodo">編輯</button>
        <button @click="delTodo">X</button>
      </div>
    
    </template>
    <style scoped>
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