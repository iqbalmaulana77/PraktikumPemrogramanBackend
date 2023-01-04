// TODO 3: Import data students dari folder data/students.js
import Student from "../model/Student.js"

// Membuat Class StudentController
class StudentController {
	async index(req, res) {
		// TODO 4: Tampilkan data students
		try {
			const students = await Student.all()
			const data = {
				message: "Menampilkkan semua students",
				data: students
			}

			res.json(data)
		} catch (error) {
			res.status(400).json({
				message: 'Bad Request',
				response: 'Something went wrong'
			})
		}
	}

	async show(req, res) {
		try {
			const { id } = req.params
			const students = await Student.findById(id)

			if (students.length == 0) {
				return res.status(404).json({ message: 'Data not found' })
			}

			const data = {
				message: `Menampilkan student id ${id}`,
				data: students[0]
			}

			res.json(data)
		} catch (error) {
			res.status(400).json({
				message: 'Bad Request',
				response: 'Something went wrong'
			})
		}
	}

	async store(req, res) {
		try {
			const { nama, nim, email, jurusan } = req.body;
			// TODO 5: Tambahkan data students
			const students = await Student.create({ nama, nim, email, jurusan })

			const data = {
				message: `Menambahkan data student: ${nama}`,
				data: {
					id: students.insertId,
					nama,
					nim,
					email,
					jurusan
				}
			}

			res.json(data)
			
		} catch (error) {
			res.status(400).json({
				message: 'Bad Request',
				response: 'Something went wrong'
			})
		}
	}

	async update(req, res) {
		try {
			const { id } = req.params
			const { nama, nim, email, jurusan } = req.body

			const students = await Student.findById(id)
			if (students.length == 0) {
				return res.status(404).json({ message: 'Data not found' })
			}

			// TODO 6: Update data students
			await Student.update(id, { nama, nim, email, jurusan })

			const data = {
				message: `Mengedit student id: ${id}`,
				data: { id, nama, nim, email, jurusan }
			}

			res.json(data)
		} catch (error) {
			res.status(400).json({
				message: 'Bad Request',
				response: 'Something went wrong'
			})
		}
	}

	async destroy(req, res) {
		try {
			const { id } = req.params

			const students = await Student.findById(id)
			if (students.length == 0) {
				return res.status(404).json({ message: 'Data not found' })
			}

			// TODO 7: Hapus data students
			await Student.destroy(id)

			const data = {
				message: `Menghapus student id: ${id}`
			}

			res.json(data)
		} catch (error) {
			res.status(400).json({
				message: 'Bad Request',
				response: 'Something went wrong'
			})
		}
	}
}

// Membuat object StudentController
const object = new StudentController()

// Export object StudentController
export default object
