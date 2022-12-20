// TODO 3: Import data students dari folder data/students.js
import students from "../data/students.js"
import uniqid from "uniqid"

// Membuat Class StudentController
class StudentController {
  index(req, res) {
    // TODO 4: Tampilkan data students
    const data = {
      message: "Menampilkkan semua students",
      data: students,
    }

    res.json(data)
  }

  store(req, res) {
    const { name } = req.body

    // TODO 5: Tambahkan data students
    const new_data = {
      id: uniqid(),
      name
    }

    students.push(new_data)

    const data = {
      message: `Menambahkan data student: ${name}`,
      data: students,
    }

    res.json(data)
  }

  update(req, res) {
    const { id } = req.params
    const { name } = req.body

    // TODO 6: Update data students
    students.find(student => student.id == id).name = name

    const data = {
      message: `Mengedit student id ${id}, nama ${name}`,
      data: students,
    }

    res.json(data)
  }

  destroy(req, res) {
    const { id } = req.params

    // TODO 7: Hapus data students
    students.splice(students.findIndex((student) => student.id === id), 1)

    const data = {
      message: `Menghapus student id ${id}`,
      data: students,
    }

    res.json(data)
  }
}

// Membuat object StudentController
const object = new StudentController()

// Export object StudentController
export default object
