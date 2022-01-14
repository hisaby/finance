import React, { useEffect, useState } from 'react';
import { PencilAltIcon, TrashIcon } from '@heroicons/react/outline';
import { Head } from '@inertiajs/inertia-react';
import Authenticated from '@/Layouts/Authenticated';
import LoadMore from '@/Components/LoadMore';
import Create from './Create';
import Edit from './Edit';
import Delete from '@/Components/Delete';

export default function Sms({auth}) {
    const [sms, setSms] = useState([]);
    const [currentPage, setCurrentPage] = useState(1);
    const [hasMorePages, setHasMorePages] = useState(true);
    const [loading, setLoading] = useState(false);
    const [showCreate, setShowCreate] = useState(false);
    const [editItem, setEditItem] = useState(null);
    const [deleteItem, setDeleteItem] = useState(null);

    useEffect(() => {
        if(! hasMorePages) return;
        setLoading(true);

        Api.getSms(currentPage)
            .then(({data}) => {
                setSms([...sms, ...data.data.sms.data])
                setHasMorePages(data.data.sms.paginatorInfo.hasMorePages)
                setLoading(false);
            })
            .catch(console.error);
    }, [currentPage]);

    const onUpdate = (updatedItem) => {
        setSms(sms.map(item => {
            if(item.id === updatedItem.id) {
                return updatedItem
            }
            
            return item
        }));

        Engine.animateRowItem(updatedItem.id)
    }

    const onDelete = () => {
        let tempDeleteItem = deleteItem;
        setDeleteItem(null)
        Engine.animateRowItem(tempDeleteItem.id, 'deleted', () => {
            setSms(sms.filter(item => item.id != tempDeleteItem.id));
        })
    }

    return (
        <Authenticated auth={auth} 
            header={
                <div className='flex justify-between items-center'>
                    <h2 className="font-semibold text-xl text-gray-800 leading-tight">
                        SMS Parser
                    </h2>

                    <button onClick={() => setShowCreate(true)} className="inline-flex items-center px-4 py-2 bg-blue-500 hover:bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest active:bg-blue-500 transition ease-in-out duration-150">
                        Parse SMS
                    </button>
                </div>
            }>
            <Head title="SMS Parser" />

            <Create showCreate={showCreate} 
                onCreate={(createdSms) => {
                    setShowCreate(false)
                    setSms([...createdSms, ...sms])
                }}
                onClose={() => setShowCreate(false)} />
        
            <Edit sms={editItem} 
                onClose={() => setEditItem(null)} 
                onUpdate={item => {
                    onUpdate(item)
                    setEditItem(null)
                }}
                />
            
            <Delete item={deleteItem} 
                resource="Sms"
                onClose={() => setDeleteItem(null)}
                onDelete={onDelete}  />

            <div className="py-12">
                <div className="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div className="flex flex-col">
                        <div className="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                            <div className="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                                <div className="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                                    <table className="min-w-full divide-y divide-gray-200">
                                        <thead className="bg-gray-50">
                                            <tr>
                                                <th scope="col" className="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                    Id
                                                </th>
                                                <th scope="col" className="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                    Body
                                                </th>
                                                <th scope="col" className="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                    Valid
                                                </th>
                                                <th scope="col" className="relative py-3">
                                                    <span className="sr-only">Edit</span>
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody className="bg-white divide-y divide-gray-200">
                                            {sms.map((item) => (
                                                <tr key={item.id} className='loaded' id={'item-' + item.id}>
                                                    <td className="px-6 py-4 whitespace-nowrap text-sm font-bold text-gray-800">{item.id}</td>
                                                    <td className="px-6 py-4 whitespace-nowrap text-sm font-bold text-gray-800">{Engine.cutString(item.body, 50)}</td>
                                                    <td className="px-6 py-4 whitespace-nowrap text-sm font-bold text-gray-800">{item.transaction_id ? '✅' : '❌'}</td>
                                                    <td className="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                                        {! item.transaction_id && <button onClick={() => setEditItem(item)} type="button">
                                                            <span className="sr-only">Edit</span>
                                                            
                                                            <PencilAltIcon className="h-5 w-5 text-gray-500" aria-hidden="true" />
                                                        </button>}

                                                        <button onClick={() => setDeleteItem(item)} type="button" className="ml-2">
                                                            <span className="sr-only">Delete</span>
                                                            
                                                            <TrashIcon className="h-5 w-5 text-gray-500" aria-hidden="true" />
                                                        </button>
                                                    </td>
                                                </tr>
                                            ))}
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <LoadMore hasMorePages={hasMorePages} loading={loading} onClick={() => setCurrentPage(currentPage+1)} />
                    </div>
                </div>
            </div>
        </Authenticated>
    );
}