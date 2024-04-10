<script>
import bgFull from '/images/nav-full-pc.png';

export default {
  props: {
    canLogin: Boolean,
    canRegister: Boolean,
    yearSemesters: {
      type: Array,
      default: () => [],
    },
    
    course: Object,
    teacher: Object,
    schedules: Object,
  },
  data() {
    return {
      bgFull,
      selectedYearSemester: '', // 存儲所選擇的學年度和學期
      teacherData: [], // 存儲根據所選擇的學年度和學期獲取的教師資料
    };
  },
  methods: {
    
  //   getCourseName(courseId) {
  //   // 在這裡根據 courseId 從 course 物件中獲取相應的課程名稱並返回
  //   const course = this.course.find(course => course.id === courseId);
  //   return course ? course.name : '未知課程';
  // }
  },
};
</script>

<template>
  <!-- {{ schedules }} -->
  <!-- {{ teacher }} -->
  <!-- {{ course }} -->
  <div class="relative sm:flex sm:justify-center sm:items-center min-h-screen bg-dots-darker bg-center bg-gray-100 dark:bg-dots-lighter selection:bg-red-500 selection:text-white" :style="{ backgroundImage: `url(${bgFull})` }">

    <div v-if="canLogin" class="sm:fixed sm:top-0 sm:right-0 p-6 text-end text-2xl">
      <Link
        v-if="$page.props.auth.user"
        :href="route('dashboard')"
        class="font-semibold text-black"
        >
        前往後臺
      </Link>
      
      <template v-else>
        <Link :href="route('login')" class="font-semibold text-black">登入</Link>
        <Link v-if="canRegister" :href="route('register')" class="ms-4 font-semibold text-black">註冊</Link>
      </template>
    </div>
  
    <div class="w-1/2 mx-auto text-2xl">
      <ApplicationLogo class="w-40 h-40 fill-current text-gray-500 mb-20 mx-auto" />
      <div class="flex items-center gap-x-4 mb-4">
        <label>
          <select v-model="selectedYearSemester" @change="filterSchedules" class="w-[400px] border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm cursor-pointer text-2xl">
            <option value="" selected hidden>請選擇學期</option>
            <option v-for="yearSemester in yearSemesters" :value="yearSemester">{{ yearSemester }}</option>
          </select>
        </label>
        <b>學期課表</b>
      </div>
      <table class="w-full">
        <thead>
          <tr>
            <th class="text-center">序號</th>
            <th>課程名稱</th>
            <th>授課教師</th>
          </tr>
        </thead>
        <!-- <tbody>
          <tr v-for="(teacher, index) in teacher" :key="index" class="text-center">
            <td>{{ index + 1 }}</td>
            <td>{{ getCourseName(teacher.course_id) }}</td>
            <td>{{ teacher.name }}</td>
          </tr>
        </tbody> -->
        <tbody>
          <tr v-for="(schedules, index) in schedules" :key="index" class="text-center">
            <td>{{ index + 1 }}</td>
            <td>{{ schedules.content }}</td>
            <td>{{ teacher.name }}</td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</template>

<style scoped>
th, td {
  @apply py-1 px-2 border-2 border-black;
}
</style>
