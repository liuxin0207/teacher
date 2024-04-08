<script>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';

export default {
  components: {
    AuthenticatedLayout,
  },
  props: {
    response: Object,
  },
  data() {
    return {
      form: {
        year: this.response.year,
        semester: this.response.semester,
        content: this.response.content,
      },
      selectedTeacher: null,
      selectedCourse: '',
    };
  },
  computed: {
    semesterSchedule() {
      const arr = this.response.teacherData.filter(teacher => this.form.content.includes(teacher.id));

      return arr;
    },
  },
  methods: {
    selectTeacher(teacherId) {
      this.selectedTeacher = teacherId;
    },
    switchTeacher() {
      // 檢查是否有選擇老師，沒有就跳提醒
      if (!this.selectedTeacher) {
        return Swal.fire('請選擇老師');
      }

      // 找出content內是否已存在該老師的id
      const existed = this.form.content.includes(this.selectedTeacher);

      // 假如有的話則刪除，沒有則新增
      if (existed) {
        this.form.content = this.form.content.filter(id => id !== this.selectedTeacher);
      } else {
        this.form.content.push(this.selectedTeacher);
      }
    },
    storeSchedule() {
      Swal.fire({
        title: '確定要儲存嗎?', // 彈跳視窗的標題
        icon: 'question', // icon的樣式
        showCancelButton: true, // 要不要顯示取消按鈕
        confirmButtonText: '確定', // 確定按鈕的文字內容
        cancelButtonText: '取消', // 取消按鈕的文字內容
      }).then((result) => {
        if (result.isConfirmed) {
          // 要執行的事情
          const fromData = {
            year: this.form.year,
            semester: this.form.semester,
            content: JSON.stringify(this.form.content),
          };

          this.$inertia.post(route('schedule.update', { id: this.response.id }), fromData, {
            onSuccess: (res) => {
              const msg = res.props.flash.message;
              Swal.fire(msg);
            },
          });
        }
      });
    },
  },
};
</script>

<template>
  <AuthenticatedLayout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">編輯課表</h2>
    </template>

    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="p-6 bg-white overflow-hidden shadow-sm sm:rounded-lg">
          <form class="flex flex-col gap-y-4" @submit.prevent="storeSchedule">
            <div class="grid grid-cols-2 gap-x-4">
              <div>
                <InputLabel for="year" value="學年度" />
                <input
                  v-model.number="form.year"
                  id="year"
                  type="number"
                  class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full"
                  maxlength="50"
                  required
                />
              </div>

              <div>
                <InputLabel for="semester" value="學期" />
                <TextInput
                  v-model="form.semester"
                  id="semester"
                  type="text"
                  class="mt-1 block w-full"
                  maxlength="50"
                />
              </div>
            </div>

            <div class="flex items-center justify-between">
              <div class="w-[450px] h-[500px] border border-black rounded-md overflow-y-auto">
                <p class="rounded-t-md p-2 border-b border-black bg-gray-300 text-center font-bold">全部課程</p>
                <ul class="grid grid-cols-2 text-center border-b border-black p-2 bg-gray-300 font-bold">
                  <li>課程</li>
                  <li>教師</li>
                </ul>
                <button v-for="teacher in response.teacherData" :key="teacher.id"  type="button" class="grid grid-cols-2 w-full p-2 border-b text-center cursor-pointer hover:bg-slate-50" :class="{ 'selected': selectedTeacher === teacher.id }"  @click="selectTeacher(teacher.id)">
                  <div>{{ teacher.course_name }}</div>
                  <div>{{ teacher.name }}</div>
                </button>
              </div>
              <button type="button" class="text-9xl opacity-50 hover:opacity-100" @click="switchTeacher">⇆</button>
              <div class="w-[450px] h-[500px] border border-black rounded-md overflow-y-auto">
                <p class="rounded-t-md p-2 border-b border-black bg-gray-300 text-center font-bold">學期課程</p>
                <ul class="grid grid-cols-2 text-center border-b border-black p-2 bg-gray-300 font-bold">
                  <li>課程</li>
                  <li>教師</li>
                </ul>
                <button  v-for="teacher in semesterSchedule" :key="teacher.id" type="button" class="grid grid-cols-2 w-full p-2 border-b text-center cursor-pointer hover:bg-slate-50" :class="{ 'selected': selectedTeacher === teacher.id }" @click="selectTeacher(teacher.id)">
                  <div>{{ teacher.course_name }}</div>
                  <div>{{ teacher.name }}</div>
                </button>
              </div>
            </div>

            <div class="flex justify-center gap-x-4 pt-8">
              <Link :href="route('schedule.index')" class="inline-block px-4 py-2 rounded-md bg-gray-500 text-white font-bold">
                返回列表
              </Link>
              <button type="submit" class="px-4 py-2 rounded-md bg-blue-500 text-white font-bold" >
                儲存
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </AuthenticatedLayout>
</template>

<style scoped>
.selected {
  @apply bg-blue-600 text-white;
}
</style>
