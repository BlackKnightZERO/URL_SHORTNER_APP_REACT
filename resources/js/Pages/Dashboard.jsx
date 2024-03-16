import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import Table from './Profile/Partials/Table';
import { Head } from '@inertiajs/react';

import InputError from '@/Components/InputError';
import InputLabel from '@/Components/InputLabel';
import TextInput from '@/Components/TextInput';
import { useForm } from '@inertiajs/react';

export default function Dashboard({ auth, base_url, short_url, long_url, urls  }) {
    
    const { data, setData, post, errors, processing, recentlySuccessful } = useForm({
        long_url: '',
        short_url: ''
    });
    
    const submit = (e) => {
        e.preventDefault();
        post(route('shorten.create'));
    };
    
    return (
        <AuthenticatedLayout
            user={auth.user}
            header={<h2 className="font-semibold text-xl text-gray-800 leading-tight">Dashboard</h2>}
        >
            <Head title="Dashboard" />
            <>
            <div className="py-12">
                <div className="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div className="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        {/* <div className="p-6 text-gray-900">You're logged in!</div> */}
                        <div className="grid grid-cols-2 gap-4">
                            <div className="my-2">
                                <form onSubmit={submit} >
                                    <InputLabel htmlFor="url" value="Url" />
                                    <div className="relative">
                                        <div className="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                                            <svg width="60%" height="60%" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M21.1525 10.8995L12.1369 19.9151C10.0866 21.9653 6.7625 21.9653 4.71225 19.9151C2.662 17.8648 2.662 14.5407 4.71225 12.4904L13.7279 3.47483C15.0947 2.108 17.3108 2.108 18.6776 3.47483C20.0444 4.84167 20.0444 7.05775 18.6776 8.42458L10.0156 17.0866C9.33213 17.7701 8.22409 17.7701 7.54068 17.0866C6.85726 16.4032 6.85726 15.2952 7.54068 14.6118L15.1421 7.01037" stroke="currentColor" strokeWidth="1" strokeLinecap="round" strokeLinejoin="round"/>
                                            </svg>
                                        </div>
                                        <TextInput
                                            id="long_url"
                                            name="long_url"
                                            value={data.long_url}
                                            onChange={(e) => setData('long_url', e.target.value)}
                                            required
                                            isFocused
                                            className="block w-full p-4 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                        />
                                        <button type="submit" className="text-white absolute end-2.5 bottom-2.5 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Shorten</button>
                                    </div>
                                    <InputError className="mt-2" message={errors.long_url} />
                                </form>
                            </div>
                            <div  className="my-2">
                                <InputLabel htmlFor="short_url" value="Short Url" />
                                <div className="relative">
                                    <div className="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                                        <svg width="60%" height="60%" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M21.1525 10.8995L12.1369 19.9151C10.0866 21.9653 6.7625 21.9653 4.71225 19.9151C2.662 17.8648 2.662 14.5407 4.71225 12.4904L13.7279 3.47483C15.0947 2.108 17.3108 2.108 18.6776 3.47483C20.0444 4.84167 20.0444 7.05775 18.6776 8.42458L10.0156 17.0866C9.33213 17.7701 8.22409 17.7701 7.54068 17.0866C6.85726 16.4032 6.85726 15.2952 7.54068 14.6118L15.1421 7.01037" stroke="currentColor" strokeWidth="1" strokeLinecap="round" strokeLinejoin="round"/>
                                        </svg>
                                    </div>
                                    <TextInput
                                        id="short_url"
                                        name="short_url"
                                        value={ short_url != '' ? base_url+short_url : '' }
                                        readOnly
                                        className="block w-full p-4 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div className="py-2">
                <div className="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div className="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div className="flex flex-col">
                            <div className="overflow-x-auto sm:-mx-6 lg:-mx-8">
                                <div className="inline-block min-w-full py-2 sm:px-6 lg:px-8">
                                    <div className="overflow-hidden">
                                        <Table urls={urls} />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </>
        </AuthenticatedLayout>
    );
}
