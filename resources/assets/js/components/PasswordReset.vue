<template>
  <Row>
    <Col span="8" push="8">
    <Form ref="form" :model="form" :label-width="80" :rules="rule">
      <FormItem label="邮箱">
        <Input name="email" type="email" v-model="form.email" clearable> </Input>
      </FormItem>
      <FormItem label="密码">
        <Input name="password" type="password" v-model="form.password" clearable> </Input>
      </FormItem>
      <FormItem label="确认密码">
        <Input name="password_confirmation" type="password" v-model="form.password_confirmation" clearable></Input>
      </FormItem>
      <ButtonGroup style="float: right">
        <i-button type="primary" @click="handleSubmit">提交</i-button>
        <i-button type="warning" html-type="reset">重置</i-button>
      </ButtonGroup>
    </Form>
    </Col>
  </Row>
</template>

<script>
import axios from 'axios'

export default {
    methods: {
        handleSubmit() {
            axios
                .post('/password/reset', {
                    email: this.form.email,
                    password: this.form.password,
                    password_confirmation: this.form.password_confirmation,
                    token: this.$route.params.token
                })
                .then(res => {
                    this.$Message.success(res)
                })
                .catch(err => {
                    this.$Message.success(err)

                })
        }
    },
    data() {
        return {
            form: {
                email: '',
                password: '',
                password_confirmation: ''
            },
            rule: {
                password: [
                    {
                        required: true,
                        message: 'Please fill in the password.',
                        trigger: 'blur'
                    },
                    {
                        type: 'string',
                        min: 4,
                        message:
                            'The password length cannot be less than 6 bits.',
                        trigger: 'blur'
                    }
                ]
            }
        }
    }
}
</script>
