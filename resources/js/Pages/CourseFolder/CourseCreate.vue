<script>
  import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';

  export default {
    components: {
      AuthenticatedLayout,
    },
    data() {
      return {
        form: {
          name: '',
          description: '',
          photo: '',
        },
        templatePhoto: '',
      };
    },
    methods: {
      putImg(e) {
        const file = e.target.files[0];
        this.form.photo = file;
        this.templatePhoto = URL.createObjectURL(file);
      },
      storeCourse() {
        Swal.fire({
          title: '確定要儲存嗎?',
          icon: 'question',
          showCancelButton: true,
          confirmButtonText: '確定',
          cancelButtonText: '取消',
        }).then((result) => {
          if (result.isConfirmed) {
            this.$inertia.post(route('course.store'), this.form, {
              onSuccess: () => {
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
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">新增課程</h2>
    </template>

    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="p-6 bg-white overflow-hidden shadow-sm sm:rounded-lg">
          <form class="flex flex-col gap-y-4" @submit.prevent="storeCourse" >
            <div>
              <InputLabel for="name" value="課程名稱" />
              <TextInput v-model="form.name" id="name" type="text" class="mt-1 block w-full" maxlength="50" required />
            </div>

            <div>
              <InputLabel for="description" value="課程簡介" />
              <TextInput v-model="form.description" id="description" type="text" class="mt-1 block w-full"
                maxlength="255" />
            </div>

            <div>
              <InputLabel value="課程照片" />
              <label for="photo"
                class="flex items-center justify-center w-[356px] h-[200px] mt-1 text-gray-400 bg-gray-100 rounded-md text-2xl font-bold cursor-pointer">
                <img v-if="templatePhoto" :src="templatePhoto" alt="課程照片" class="object-cover h-[200px]">
                <span v-else>點擊上傳照片</span>
                <input id="photo" type="file" class="sr-only" @change="putImg">
              </label>
            </div>

            <div class="flex justify-center gap-x-4 pt-8">
              <Link :href="route('course.index')"
                class="inline-block px-4 py-2 rounded-md bg-gray-500 text-white font-bold">
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