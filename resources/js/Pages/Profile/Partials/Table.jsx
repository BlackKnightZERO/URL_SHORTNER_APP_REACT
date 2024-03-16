export default function Table({ urls }) {
    return (
        <>
            <table className="min-w-full text-left text-sm font-light">
                <thead className="border-b font-medium dark:border-neutral-500">
                    <tr>
                        <th scope="col" className="px-6 py-4">#</th>
                        <th scope="col" className="px-6 py-4">URL</th>
                        <th scope="col" className="px-6 py-4">Short URL</th>
                        <th scope="col" className="px-6 py-4">Visit Count</th>
                        <th scope="col" className="px-6 py-4">Action</th>
                    </tr>
                </thead>
                <tbody>
                    {
                        urls.map((item, idx) => (
                            <tr className="border-b dark:border-neutral-500">
                                <td className="whitespace-nowrap px-6 py-4 font-medium">{ idx + 1 }</td>
                                <td className="whitespace-nowrap px-6 py-4">{ item.long_url }</td>
                                <td className="whitespace-nowrap px-6 py-4">{ item.short_url }</td>
                                <td className="whitespace-nowrap px-6 py-4">{ item.visit_count }</td>
                                <td className="whitespace-nowrap px-6 py-4">                       
                                    <a href={item.short_url} target="_blank" className="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Visit</a>
                                </td>
                            </tr>
                        ))
                    }
                </tbody>
            </table>
        </>
    );
}