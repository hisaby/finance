import React, { useEffect } from 'react';
import Button from '@/Components/Global/Button';
import Guest from '@/Layouts/Guest';
import Input from '@/Components/Global/Input';
import Label from '@/Components/Global/Label';
import ValidationErrors from '@/Components/Global/ValidationErrors';
import { Head, useForm } from '@inertiajs/inertia-react';

export default function Login({ status }) {
    const { data, setData, post, processing, errors, reset } = useForm({
        email: 'admin@test.com',
        password: 'admin123',
        remember: '',
    });

    useEffect(() => {
        return () => {
            reset('password');
        };
    }, []);

    const onHandleChange = (event) => {
        setData(event.target.name, event.target.value);
    };

    const submit = (e) => {
        e.preventDefault();

        post(route('login'));
    };

    return (
        <Guest>
            <Head title="Log in" />

            {status && <div className="mb-4 font-medium text-sm text-green-600">{status}</div>}

            <ValidationErrors errors={errors} />

            <form onSubmit={submit}>
                <div>
                    <Label forInput="email" value="Email" />

                    <Input
                        type="text"
                        name="email"
                        value={data.email}
                        className="mt-1 block w-full"
                        autoComplete="username"
                        handleChange={() => {}}
                    />
                </div>

                <div className="mt-4">
                    <Label forInput="password" value="Password" />

                    <Input
                        type="password"
                        name="password"
                        value={data.password}
                        className="mt-1 block w-full"
                        autoComplete="current-password"
                        handleChange={() => {}}
                    />
                </div>

                <div className="flex items-center justify-end mt-4">
                    <Button className="ml-4" processing={processing}>
                        Log in
                    </Button>
                </div>
            </form>
        </Guest>
    );
}
