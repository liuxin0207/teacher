<script>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';

export default {
  components: {
    AuthenticatedLayout,
  },
  props: {
    response: {
      type: Array,
    },
  },
  methods: {
    deleteSchedule(id){
      Swal.fire({
          title: '確定要刪除嗎?',
          icon: 'question',
          showCancelButton: true,
          confirmButtonText: '確定',
          cancelButtonText: '取消',
        }).then((result) => {
          if (result.isConfirmed) {
            this.$inertia.post(route('schedule.destroy', { id: id }), {}, {
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
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">課表列表</h2>
    </template>

    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="p-6 bg-white overflow-hidden shadow-sm sm:rounded-lg">
          <Link :href="route('schedule.create')" class="inline-block px-4 py-2 mb-4 rounded-md bg-green-500 text-white font-bold">
            新增
          </Link>

          <table class="w-full">
            <thead>
              <tr>
                <th class="w-[100px]">序號</th>
                <th>學年</th>
                <th>學期</th>
                <th class="w-[250px]">操作</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="schedule in response" :key="schedule.id" class="text-center">
                <td class="w-[100px]">1</td>
                <td>{{ schedule.year }}</td>
                <td>{{ schedule.semester }}</td>
                <td class="w-[250px]">
                  <div class="flex justify-center gap-x-2">
                    <button type="button" class="inline-block px-4 py-2 rounded-md bg-green-800 text-white font-bold">
                      寄送
                    </button>
                    <Link :href="route('schedule.edit', { id: schedule.id })" class="inline-block px-4 py-2 rounded-md bg-blue-500 text-white font-bold">
                      編輯
                    </Link>
                    <button type="button" class="px-4 py-2 rounded-md bg-red-500 text-white font-bold" @click="deleteSchedule(schedule.id)">
                      刪除
                    </button>
                  </div>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </AuthenticatedLayout>
</template>

<style scoped>
th, td {
  @apply py-1 px-2 border border-black;
}
</style>
