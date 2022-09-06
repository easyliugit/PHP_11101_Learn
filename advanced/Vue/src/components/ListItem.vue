<script setup>
  import { propsToAttrMap } from '@vue/shared';
  import {ref,reactive,watch} from 'vue'
  const props=defineProps({todo:Object})
  const emits=defineEmits(['delTodo'])
  const item=ref();
  //const form=reactive(props.todo)
  const delTodo=()=>{
      emits('delTodo')
  }
  const edit=ref(false)
  const editTodo=()=>{
    //console.log(items.value[idx].childNodes)
    edit.value=true
  }
  const updateTodo=()=>{
      edit.value=false
  }
  </script>
  <template>
  
  <div class="list-item" ref="item">
      <div>
          <span v-if="!edit">{{ todo.todo }}</span>
          <input v-if="edit" type="text" v-model="todo.todo">
      </div>
      <div>
          <span  v-if="!edit">{{ todo.due }}</span>
          <input v-if="edit" type="date" v-model="todo.due">
      </div>
      <div>
          <span  v-if="!edit">{{ todo.type }}</span>
  
          <select v-if="edit" name="type"  v-model="todo.type">
              <option value="1">很重要</option>
              <option value="2">普通</option>
              <option value="3">不重要</option>
          </select>
      </div>
      <button  v-if="edit" @click="updateTodo">OK</button>
      <button  v-if="!edit" @click="editTodo">編輯</button>
      <button  v-if="!edit" @click="delTodo">X</button>
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