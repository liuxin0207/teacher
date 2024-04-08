<script>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';

export default {
  components: {
    AuthenticatedLayout,
  },
  props: {
    response: Array,
  },
  data() {
    return {
      form: {
        courseId: '',
        name: '',
        description: '',
      },
    };
  },
  methods: {
    storeCourse() {
        Swal.fire({
          title: '確定要儲存嗎?',
          icon: 'question',
          showCancelButton: true,
          confirmButtonText: '確定',
          cancelButtonText: '取消',
        }).then((result) => {
          if (result.isConfirmed) {
            this.$inertia.post(route('teacher.store'), this.form, {
              onSuccess: (res) => {
                const msg = res.props.flash.message;
                Swal.fire(msg);
              },
            });
          }
        })

      }
  },
};
</script>

<template>
  <AuthenticatedLayout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">新增教師</h2>
    </template>

    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="p-6 bg-white overflow-hidden shadow-sm sm:rounded-lg">
          <form class="flex flex-col gap-y-4" @submit.prevent="storeCourse">
            <div>
              <InputLabel for="course" value="課程" />
              <select v-model="form.courseId" id="course" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm cursor-pointer" required>
                <option value="" selected hidden>請選擇課程</option>
                <option v-for="course in response" :key="course.id"  :value="course.id">
                  {{ course.name }}
                </option>
              </select>
            </div>

            <div>
              <InputLabel for="name" value="教師姓名" />
              <TextInput
                v-model="form.name"
                id="name"
                type="text"
                class="mt-1 block w-full"
                maxlength="50"
                required
              />
            </div>

            <div>
              <InputLabel for="description" value="教師簡介" />
              <TextInput
                v-model="form.description"
                id="description"
                type="text"
                class="mt-1 block w-full"
                maxlength="255"
              />
            </div>

            <div class="flex justify-center gap-x-4 pt-8">
              <Link :href="route('teacher.index')" class="inline-block px-4 py-2 rounded-md bg-gray-500 text-white font-bold">
                返回列表
              </Link>
              <button type="submit" class="px-4 py-2 rounded-md bg-blue-500 text-white font-bold">
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

</style>
