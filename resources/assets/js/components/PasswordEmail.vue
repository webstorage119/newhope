<template>
    <Form ref="formInline" :model="formInline" :rules="ruleInline" inline>
        <FormItem prop="email">
            <Input type="email" v-model="formInline.email" placeholder="Email">
                <Icon type="ios-email-outline" slot="prepend"></Icon>
            </Input>
        </FormItem>
        <FormItem>
            <Button type="primary" @click="handleSubmit('formInline')">发送密码重置邮件</Button>
        </FormItem>
    </Form>
</template>
<script>
import axios from 'axios'
export default {
    data () {
        return {
            formInline: {
                email: ''
            },
            ruleInline: {
                email: [
                    {
                        required: true,
                        message: 'Please fill in the email',
                        trigger: 'blur'
                    }
                ]
            }
        }
    },
    methods: {
        handleSubmit(name) {
            this.$refs[name].validate((valid) => {
                if (valid) {
                    axios
                        .post('password/email', {
                            email: this.formInline.email
                        })
                        .then(res => {
                            this.$Message.success(res.data.message)
                            // window.history.length > 0
                            //     ? this.$router.go(-1)
                            //     : this.$router.push('/')
                        })
                        .catch(err => {
                            this.$Message.error(err)
                        })
                } else {
                    this.$Message.error('Fail!')
                }
            })
        }
    }
}
</script>
