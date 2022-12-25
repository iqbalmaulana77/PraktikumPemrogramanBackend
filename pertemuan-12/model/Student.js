import db from "../config/database.js"

class Student {
    static table = 'students';

    // Get All Students
    static all() {
        return new Promise((resolve, reject) => {
            const query = `SELECT * FROM ${this.table}`
            db.query(query, (err, result) => {
                if (err) reject(err)
                resolve(result)
            })
        })
    }

    // Get Student by ID
    static findById(id) {
        return new Promise((resolve, reject) => {
            const query = `SELECT * FROM ${this.table} WHERE id = '${id}'`
            db.query(query, (err, result) => {
                if (err) reject(err)
                resolve(result)
            })
        })
    }

    // Create Student
    static create(data) {
        return new Promise((resolve, reject) => {
            const query = `INSERT INTO ${this.table} SET ?`
            db.query(query, data, (err, result) => {
                console.log(err)
                if (err) reject(err)
                resolve(result)
            })
        })
    }

    // Update Student
    static update(id, data) {
        return new Promise((resolve, reject) => {
            const query = `UPDATE ${this.table} SET ? WHERE id = '${id}'`
            db.query(query, data, (err, result) => {
                if (err) reject(err)
                resolve(result)
            })
        })
    }

    // Delete Student
    static destroy(id) {
        return new Promise((resolve, reject) => {
            const query = `DELETE FROM ${this.table} WHERE id = '${id}'`
            db.query(query, (err, result) => {
                if (err) reject(err)
                resolve(result)
            })
        })
    }
}

export default Student
