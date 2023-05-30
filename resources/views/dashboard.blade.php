<x-app-layout>


    <div class="p-4" x-data="{
        copied:false,
        copy(){
            let self = this
            self.copied = true
                        setTimeout(() => {
                            self.copied = false
                        }, 1000);
                       this.copyText()
        },

        copyText(){
            const textToCopy = '{{$user->url}}';

            const tempInput = document.createElement('input');
            tempInput.value = textToCopy;
            document.body.appendChild(tempInput);

            tempInput.select();
            tempInput.setSelectionRange(0, 99999);

            document.execCommand('copy');

            document.body.removeChild(tempInput);
        }
    }">
        <div class="flex justify-center items-center flex-col">
            <h2 class="text-5xl font-bold">
                Linker
            </h2>

            <div x-show="copied" id="toast-success" class="flex fixed bottom-5 right-5 items-center w-full max-w-xs p-4 mb-4 text-gray-500 bg-white rounded-lg shadow dark:text-gray-400 dark:bg-gray-800" role="alert">
                <div class="inline-flex items-center justify-center flex-shrink-0 w-8 h-8 text-green-500 bg-green-100 rounded-lg dark:bg-green-800 dark:text-green-200">
                    <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path></svg>
                    <span class="sr-only">Check icon</span>
                </div>
                <div class="ml-3 text-sm font-normal capitalize">Copied to clipboard </div>
            </div>




            <button @click="copy" data-tooltip-target="tooltip-right" data-tooltip-placement="right"
                class="inline-flex items-center justify-center p-5 my-3 text-base font-medium text-black rounded-lg bg-gray-200 hover:text-gray-900 hover:bg-gray-200 dark:text-gray-400 dark:bg-gray-800 dark:hover:bg-gray-700 dark:hover:text-white">

                <span class="w-full font-bold">{{$user->url}}</span>
                <svg class="w-10 h-10" viewBox="0 0 256 256" xmlns="http://www.w3.org/2000/svg" fill="#000000"
                    stroke="#000000">
                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                    <g id="SVGRepo_iconCarrier">
                        <path
                            d="M48.186 92.137c0-8.392 6.49-14.89 16.264-14.89s29.827-.225 29.827-.225-.306-6.99-.306-15.88c0-8.888 7.954-14.96 17.49-14.96 9.538 0 56.786.401 61.422.401 4.636 0 8.397 1.719 13.594 5.67 5.196 3.953 13.052 10.56 16.942 14.962 3.89 4.402 5.532 6.972 5.532 10.604 0 3.633 0 76.856-.06 85.34-.059 8.485-7.877 14.757-17.134 14.881-9.257.124-29.135.124-29.135.124s.466 6.275.466 15.15-8.106 15.811-17.317 16.056c-9.21.245-71.944-.49-80.884-.245-8.94.245-16.975-6.794-16.975-15.422s.274-93.175.274-101.566zm16.734 3.946l-1.152 92.853a3.96 3.96 0 0 0 3.958 4.012l73.913.22a3.865 3.865 0 0 0 3.91-3.978l-.218-8.892a1.988 1.988 0 0 0-2.046-1.953s-21.866.64-31.767.293c-9.902-.348-16.672-6.807-16.675-15.516-.003-8.709.003-69.142.003-69.142a1.989 1.989 0 0 0-2.007-1.993l-23.871.082a4.077 4.077 0 0 0-4.048 4.014zm106.508-35.258c-1.666-1.45-3.016-.84-3.016 1.372v17.255c0 1.106.894 2.007 1.997 2.013l20.868.101c2.204.011 2.641-1.156.976-2.606l-20.825-18.135zm-57.606.847a2.002 2.002 0 0 0-2.02 1.988l-.626 96.291a2.968 2.968 0 0 0 2.978 2.997l75.2-.186a2.054 2.054 0 0 0 2.044-2.012l1.268-62.421a1.951 1.951 0 0 0-1.96-2.004s-26.172.042-30.783.042c-4.611 0-7.535-2.222-7.535-6.482S152.3 63.92 152.3 63.92a2.033 2.033 0 0 0-2.015-2.018l-36.464-.23z"
                            stroke="#ffffff" fill-rule="evenodd"></path>
                    </g>
                </svg>

                    <div  id="tooltip-right" role="tooltip"
                        class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700 capitalize">
                        <span x-text="'click to copy'">

                        </span>


                        <div class="tooltip-arrow" data-popper-arrow></div>
                    </div>


                </a>


        </div>
    </div>

    <div class="flex justify-center p-3">
        <div x-init="links = {{$user->links->count()}} == 0 ? [{title:'',url:''},] : {{$user->links}} "
        x-data="{
    links:[],
    saved:false,

    addField(){
        this.links.push({title:'',url:''})
    },

    deleteField(index){

        let id = this.links[index]['id'];

        const url = `{{route('links.destroy',':id')}}`.replace(':id', id);
        const self = this

        if(id == undefined){
            if(this.links.length == 1){
                alert('You can not delete all fields')
                return
            }

            this.links.splice(index,1)
            return
        }

        fetch(url, {
            method: 'DELETE',
            _token: '{{ csrf_token() }}',
            headers: {
              'Accept': 'application/json',
              'X-Requested-With': 'XMLHttpRequest',
              'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
          })
           .then(response => response.json())
            .then(data => {

                self.links = data.links

            })
            .catch(error => {
              // Handle any errors that occur during the request
            });

    },

    save(){
        let url = `{{route('links.store')}}`
        let data = new FormData();
        let self = this
       data.append('_token', '{{ csrf_token() }}');
       data.append('links', JSON.stringify(this.links));

     fetch(url, {
        method: 'POST',
        _token: '{{ csrf_token() }}',
        body: data,
        headers: {
          'Accept': 'application/json',
          'X-Requested-With': 'XMLHttpRequest',
          'X-CSRF-TOKEN': '{{ csrf_token() }}'
        }
      })
        .then(response => response.json())
  .then(data => {
    self.saved = true
    setTimeout(() => {
        self.saved = false
    }, 2000);
    console.log(data.links)

    self.links = data.links
  })
        .catch(error => {
          // Handle any errors that occur during the request
        });
    }
}" class="w-1/2 p-4 bg-white border border-gray-200 rounded-lg shadow  dark:bg-gray-800 dark:border-gray-700">
            <div x-show="!!saved" id="toast-success" class="flex fixed bottom-5 right-5 items-center w-full max-w-xs p-4 mb-4 text-gray-500 bg-white rounded-lg shadow dark:text-gray-400 dark:bg-gray-800" role="alert">
                <div class="inline-flex items-center justify-center flex-shrink-0 w-8 h-8 text-green-500 bg-green-100 rounded-lg dark:bg-green-800 dark:text-green-200">
                    <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path></svg>
                    <span class="sr-only">Check icon</span>
                </div>
                <div class="ml-3 text-sm font-normal capitalize">Saved Successfully </div>
            </div>
            <form class="space-y-6" action="#" @submit.prevent="save">
                @csrf

                <div class="mx-3">
                    <template x-for="link,index in links">
                        <div class="flex justify-center">
                            <div class="mx-2 w-1/5">
                                <label for="title"
                                    class="block mb-2 pt-2 text-sm font-medium text-gray-900 dark:text-white capitalize">title</label>
                                <input x-model="links[index]['title']" type="text" id="title"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                                    autocomplete="off" placeholder="e.g:Facebook" required>
                            </div>

                            <div class="mx-2 w-3/5">
                                <label for="url"
                                    class="block mb-2 pt-2 text-sm font-medium text-gray-900 dark:text-white uppercase">url</label>
                                <input x-model="links[index]['url']" type="url" name="url" id="url"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                                    autocomplete="off" placeholder="http://facebook.com/laravelboy" required>
                            </div>

                            <div class="w-auto mt-9">
                                <button @click="deleteField(index)" data-tooltip-target="tooltip-delete"
                                    data-tooltip-placement="right" type="button"
                                    class="text-white mb-2 pt-2 bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-md text-sm p-2.5 text-center inline-flex items-center mr-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800 w-10 h-10 mx-7">

                                    <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" fill="#ffffff"
                                        stroke="#ffffff">
                                        <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round">
                                        </g>
                                        <g id="SVGRepo_iconCarrier">
                                            <title></title>
                                            <g id="Complete">
                                                <g id="minus">
                                                    <line fill="none" stroke="#ffffff" stroke-linecap="round"
                                                        stroke-linejoin="round" stroke-width="2" x1="4" x2="20" y1="12"
                                                        y2="12"></line>
                                                </g>
                                            </g>
                                        </g>
                                    </svg>

                                    <div id="tooltip-delete" role="tooltip"
                                        class="absolute capitalize z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
                                        delete
                                        <div class="tooltip-arrow" data-popper-arrow></div>
                                    </div>
                                </button>
                            </div>
                        </div>
                    </template>
                </div>
                <button @click="addField" data-tooltip-target="tooltip-add" data-tooltip-placement="right"
                    type="button"
                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-md text-sm p-2.5 text-center inline-flex items-center mr-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 w-10 h-10 mx-7">
                    <svg class="w-8 h-8" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                        viewBox="0,0,256,256" width="144px" height="144px" fill-rule="evenodd">
                        <g fill="#ffffff" fill-rule="evenodd" stroke="none" stroke-width="1" stroke-linecap="butt"
                            stroke-linejoin="miter" stroke-miterlimit="10" stroke-dasharray="" stroke-dashoffset="0"
                            font-family="none" font-weight="none" font-size="none" text-anchor="none"
                            style="mix-blend-mode: normal">
                            <g transform="scale(10.66667,10.66667)">
                                <path d="M11,2v9h-9v2h9v9h2v-9h9v-2h-9v-9z" />
                            </g>
                        </g>
                    </svg>
                    <span class="sr-only">Icon description</span>

                    <div id="tooltip-add" role="tooltip"
                        class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
                        Add new URL
                        <div class="tooltip-arrow" data-popper-arrow></div>
                    </div>
                </button>
                <hr>
                <div class="flex w-full justify-center">
                    <button type="submit"
                        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">SAVE</button>

                </div>
            </form>
        </div>




    </div>

</x-app-layout>
